<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class KhipuService
{
    private $client;
    private $baseUrl;
    private $receiverId;
    private $secret;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('services.khipu.base_url', 'https://khipu.com/api/2.0');
        $this->receiverId = config('services.khipu.receiver_id');
        $this->secret = config('services.khipu.secret');
    }

    public function createPayment($subject, $amount, $currency = 'CLP', $notifyUrl = null, $returnUrl = null, $transactionId = null)
    {
        try {
            $data = [
                'subject' => $subject,
                'amount' => $amount,
                'currency' => $currency,
                'transaction_id' => $transactionId,
                'notify_url' => $notifyUrl,
                'return_url' => $returnUrl,
                'expires_date' => now()->addHours(24)->format('Y-m-d\TH:i:s')
            ];

            $headers = [
                'Authorization' => 'Bearer ' . $this->generateAuthToken($data),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ];

            $response = $this->client->post($this->baseUrl . '/payments', [
                'headers' => $headers,
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            Log::info('Khipu payment created', [
                'payment_id' => $result['payment_id'] ?? null,
                'payment_url' => $result['payment_url'] ?? null,
                'amount' => $amount,
                'subject' => $subject
            ]);

            return [
                'success' => true,
                'payment_id' => $result['payment_id'],
                'payment_url' => $result['payment_url'],
                'simplified_transfer_url' => $result['simplified_transfer_url'] ?? null,
                'transfer_url' => $result['transfer_url'] ?? null,
                'app_url' => $result['app_url'] ?? null,
                'ready_for_terminal' => $result['ready_for_terminal'] ?? false
            ];
        } catch (\Exception $e) {
            Log::error('Error creating Khipu payment', [
                'error' => $e->getMessage(),
                'amount' => $amount,
                'subject' => $subject
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function getPaymentStatus($paymentId)
    {
        try {
            $data = ['payment_id' => $paymentId];
            $headers = [
                'Authorization' => 'Bearer ' . $this->generateAuthToken($data)
            ];

            $response = $this->client->get($this->baseUrl . '/payments/' . $paymentId, [
                'headers' => $headers
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return [
                'success' => true,
                'status' => $result['status'],
                'amount' => $result['amount'],
                'currency' => $result['currency'],
                'subject' => $result['subject'],
                'transaction_id' => $result['transaction_id'] ?? null,
                'full_response' => $result
            ];
        } catch (\Exception $e) {
            Log::error('Error getting Khipu payment status', [
                'error' => $e->getMessage(),
                'payment_id' => $paymentId
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function processWebhook($data)
    {
        try {
            // Verificar la autenticidad del webhook
            if (!$this->verifyWebhook($data)) {
                Log::warning('Invalid Khipu webhook signature');
                return ['success' => false, 'error' => 'Invalid signature'];
            }

            $paymentId = $data['payment_id'];
            $status = $data['status'];

            // Buscar el pago en nuestra base de datos
            $payment = Payment::where('transaction_id', $paymentId)->first();

            if (!$payment) {
                Log::warning('Payment not found for Khipu webhook', ['payment_id' => $paymentId]);
                return ['success' => false, 'error' => 'Payment not found'];
            }

            // Actualizar el estado del pago
            if ($status === 'done') {
                $payment->update([
                    'status' => 'approved',
                    'gateway_response' => $data
                ]);

                // Crear contrato si es necesario
                $this->createContractIfNeeded($payment);

                Log::info('Khipu payment approved', ['payment_id' => $paymentId]);
            } elseif ($status === 'rejected') {
                $payment->update([
                    'status' => 'rejected',
                    'gateway_response' => $data
                ]);

                Log::info('Khipu payment rejected', ['payment_id' => $paymentId]);
            }

            return ['success' => true, 'payment' => $payment];
        } catch (\Exception $e) {
            Log::error('Error processing Khipu webhook', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function generateAuthToken($data)
    {
        $concatenated = $this->receiverId;
        foreach ($data as $key => $value) {
            $concatenated .= '&' . $key . '=' . $value;
        }
        
        return hash_hmac('sha256', $concatenated, $this->secret);
    }

    private function verifyWebhook($data)
    {
        $receivedSignature = $data['signature'] ?? '';
        unset($data['signature']);
        
        $expectedSignature = $this->generateAuthToken($data);
        
        return hash_equals($expectedSignature, $receivedSignature);
    }

    private function createContractIfNeeded($payment)
    {
        $passenger = $payment->passenger;
        $program = $passenger->program;

        // Si es un servicio de reserva y es el primer pago, crear contrato
        if ($program->service_type === 'reservation' && !$passenger->contracts()->exists()) {
            $contract = $passenger->contracts()->create([
                'contract_number' => 'C-' . $program->program_number . '-' . $passenger->id,
                'contract_type' => 'reservation',
                'total_amount' => $passenger->individual_price + $passenger->price_adjustments,
                'paid_amount' => $payment->amount,
                'pending_amount' => ($passenger->individual_price + $passenger->price_adjustments) - $payment->amount,
                'status' => 'active'
            ]);

            $contract->addVoucher($payment);
        }
    }
}
