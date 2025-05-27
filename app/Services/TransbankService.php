<?php

namespace App\Services;

use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\Options;
use App\Models\Payment;
use App\Models\Passenger;
use Illuminate\Support\Facades\Log;

class TransbankService
{
    private $transaction;
    
    public function __construct()
    {
        // Configuración para ambiente de desarrollo (integración)
        $this->transaction = new Transaction();
        $this->transaction->configureForIntegration(
            config('services.transbank.commerce_code'),
            config('services.transbank.api_key')
        );
    }

    public function createTransaction($orderId, $amount, $returnUrl)
    {
        try {
            $response = $this->transaction->create(
                $orderId,
                $this->session_id = session()->getId(),
                $amount,
                $returnUrl
            );

            Log::info('Transbank transaction created', [
                'order_id' => $orderId,
                'amount' => $amount,
                'token' => $response->getToken(),
                'url' => $response->getUrl()
            ]);

            return [
                'success' => true,
                'token' => $response->getToken(),
                'url' => $response->getUrl()
            ];
        } catch (\Exception $e) {
            Log::error('Error creating Transbank transaction', [
                'error' => $e->getMessage(),
                'order_id' => $orderId,
                'amount' => $amount
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function confirmTransaction($token)
    {
        try {
            $response = $this->transaction->commit($token);

            Log::info('Transbank transaction confirmed', [
                'token' => $token,
                'response_code' => $response->getResponseCode(),
                'authorization_code' => $response->getAuthorizationCode(),
                'amount' => $response->getAmount()
            ]);

            return [
                'success' => $response->getResponseCode() === 0,
                'response_code' => $response->getResponseCode(),
                'authorization_code' => $response->getAuthorizationCode(),
                'amount' => $response->getAmount(),
                'buy_order' => $response->getBuyOrder(),
                'session_id' => $response->getSessionId(),
                'card_detail' => $response->getCardDetail(),
                'accounting_date' => $response->getAccountingDate(),
                'transaction_date' => $response->getTransactionDate(),
                'vci' => $response->getVci(),
                'full_response' => $response
            ];
        } catch (\Exception $e) {
            Log::error('Error confirming Transbank transaction', [
                'error' => $e->getMessage(),
                'token' => $token
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function processPayment($paymentId, $token)
    {
        $payment = Payment::findOrFail($paymentId);
        $confirmation = $this->confirmTransaction($token);

        if ($confirmation['success']) {
            $payment->update([
                'status' => 'approved',
                'transaction_id' => $token,
                'authorization_number' => $confirmation['authorization_code'],
                'gateway_response' => $confirmation['full_response']
            ]);

            // Crear contrato si es necesario
            $this->createContractIfNeeded($payment);

            return [
                'success' => true,
                'payment' => $payment,
                'confirmation' => $confirmation
            ];
        } else {
            $payment->update([
                'status' => 'rejected',
                'gateway_response' => $confirmation
            ]);

            return [
                'success' => false,
                'payment' => $payment,
                'error' => $confirmation['error'] ?? 'Transaction failed'
            ];
        }
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
