<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\PaymentLink;
use App\Services\TransbankService;
use App\Services\KhipuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Carbon\Carbon;

class EcommerceController extends Controller
{
    protected $transbankService;
    protected $khipuService;

    public function __construct(TransbankService $transbankService, KhipuService $khipuService)
    {
        $this->transbankService = $transbankService;
        $this->khipuService = $khipuService;
    }

    /**
     * Mostrar página principal del ecommerce con programas disponibles
     */
    public function index(Request $request)
    {
        $query = Program::with(['passengers' => function($query) {
            $query->where('status', '!=', 'cancelled');
        }])->where('active', true);

        // Filtros
        if ($request->service_type) {
            $query->where('service_type', $request->service_type);
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('destination', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->price_min) {
            $query->where('base_price', '>=', $request->price_min);
        }

        if ($request->price_max) {
            $query->where('base_price', '<=', $request->price_max);
        }

        if ($request->departure_date_from) {
            $query->where('departure_date', '>=', $request->departure_date_from);
        }

        if ($request->departure_date_to) {
            $query->where('departure_date', '<=', $request->departure_date_to);
        }

        $programs = $query->orderBy('departure_date', 'asc')
                          ->paginate(12)
                          ->withQueryString();

        // Agregar disponibilidad a cada programa
        $programs->getCollection()->transform(function ($program) {
            $program->available_spots = $program->capacity - $program->passengers->count();
            $program->is_available = $program->available_spots > 0;
            return $program;
        });

        $serviceTypes = Program::distinct()->pluck('service_type')->filter();

        return Inertia::render('Ecommerce/Index', [
            'programs' => $programs,
            'filters' => $request->only(['service_type', 'search', 'price_min', 'price_max', 'departure_date_from', 'departure_date_to']),
            'serviceTypes' => $serviceTypes
        ]);
    }

    /**
     * Mostrar detalles de un programa específico
     */
    public function show(Program $program)
    {
        $program->load(['passengers' => function($query) {
            $query->where('status', '!=', 'cancelled');
        }]);

        $program->available_spots = $program->capacity - $program->passengers->count();
        $program->is_available = $program->available_spots > 0;

        // Programas relacionados (mismo tipo de servicio)
        $relatedPrograms = Program::where('service_type', $program->service_type)
                                 ->where('id', '!=', $program->id)
                                 ->where('active', true)
                                 ->where('departure_date', '>', now())
                                 ->limit(4)
                                 ->get();

        return Inertia::render('Ecommerce/ProgramDetail', [
            'program' => $program,
            'relatedPrograms' => $relatedPrograms
        ]);
    }

    /**
     * Mostrar formulario de reserva
     */
    public function reservation(Program $program)
    {
        if (!$program->active || $program->available_spots <= 0) {
            return redirect()->route('ecommerce.show', $program)
                           ->with('error', 'Este programa no está disponible para reservas.');
        }

        return Inertia::render('Ecommerce/Reservation', [
            'program' => $program
        ]);
    }

    /**
     * Procesar reserva
     */
    public function storeReservation(Request $request, Program $program)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'document_type' => 'required|in:cedula,pasaporte,rut',
            'document_number' => 'required|string|max:50',
            'birth_date' => 'required|date|before:today',
            'address' => 'required|string|max:500',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'dietary_restrictions' => 'nullable|string|max:500',
            'medical_conditions' => 'nullable|string|max:500',
            'payment_method' => 'required|in:full,installments',
            'payment_gateway' => 'required|in:transbank,khipu'
        ]);

        if (!$program->active || $program->available_spots <= 0) {
            return response()->json(['error' => 'Programa no disponible'], 422);
        }

        DB::beginTransaction();
        try {
            // Crear pasajero
            $passenger = Passenger::create([
                'program_id' => $program->id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'dietary_restrictions' => $request->dietary_restrictions,
                'medical_conditions' => $request->medical_conditions,
                'status' => 'pending_payment',
                'registration_date' => now(),
                'individual_price' => $program->base_price
            ]);

            // Crear contrato/voucher si es necesario
            if (in_array($program->service_type, ['tours', 'excursiones'])) {
                Contract::create([
                    'passenger_id' => $passenger->id,
                    'contract_number' => 'VOUCHER-' . str_pad($passenger->id, 6, '0', STR_PAD_LEFT),
                    'contract_type' => 'voucher',
                    'total_amount' => $passenger->individual_price,
                    'status' => 'pending',
                    'issue_date' => now()
                ]);
            } else {
                Contract::create([
                    'passenger_id' => $passenger->id,
                    'contract_number' => 'CONT-' . str_pad($passenger->id, 6, '0', STR_PAD_LEFT),
                    'contract_type' => 'contract',
                    'total_amount' => $passenger->individual_price,
                    'status' => 'pending',
                    'issue_date' => now()
                ]);
            }

            // Configurar pagos según el método seleccionado
            if ($request->payment_method === 'full') {
                // Pago completo
                $this->createPayment($passenger, $passenger->individual_price, 1, 1, $request->payment_gateway);
            } else {
                // Pago en cuotas (3 cuotas por defecto)
                $installmentAmount = round($passenger->individual_price / 3, 0);
                for ($i = 1; $i <= 3; $i++) {
                    $amount = ($i === 3) ? $passenger->individual_price - (2 * $installmentAmount) : $installmentAmount;
                    $this->createPayment($passenger, $amount, $i, 3, $request->payment_gateway);
                }
            }

            DB::commit();

            // Redirigir al proceso de pago
            return response()->json([
                'success' => true,
                'passenger_id' => $passenger->id,
                'redirect_url' => route('ecommerce.payment', $passenger)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al procesar la reserva: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Mostrar página de pago
     */
    public function payment(Passenger $passenger)
    {
        $passenger->load(['program', 'payments' => function($query) {
            $query->where('status', 'pending')->orderBy('installment_number');
        }]);

        if ($passenger->status !== 'pending_payment') {
            return redirect()->route('ecommerce.index')
                           ->with('error', 'Esta reserva no requiere pago o ya ha sido procesada.');
        }

        return Inertia::render('Ecommerce/Payment', [
            'passenger' => $passenger,
            'pendingPayments' => $passenger->payments
        ]);
    }

    /**
     * Procesar pago específico
     */
    public function processPayment(Request $request, Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return response()->json(['error' => 'Este pago ya fue procesado'], 422);
        }

        try {
            if ($payment->gateway === 'transbank') {
                $result = $this->transbankService->createTransaction(
                    $payment->amount,
                    route('payment.return', ['payment' => $payment->id]),
                    $payment->id
                );

                $payment->update([
                    'gateway_transaction_id' => $result['token'],
                    'gateway_response' => json_encode($result)
                ]);

                return response()->json([
                    'success' => true,
                    'payment_url' => $result['url'] . '?token_ws=' . $result['token']
                ]);

            } elseif ($payment->gateway === 'khipu') {
                $result = $this->khipuService->createPayment(
                    $payment->amount,
                    'Pago programa ' . $payment->passenger->program->name,
                    $payment->passenger->email,
                    route('payment.return', ['payment' => $payment->id]),
                    $payment->id
                );

                $payment->update([
                    'gateway_transaction_id' => $result['payment_id'],
                    'gateway_response' => json_encode($result)
                ]);

                return response()->json([
                    'success' => true,
                    'payment_url' => $result['payment_url']
                ]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar el pago: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Página de confirmación de reserva
     */
    public function confirmation(Passenger $passenger)
    {
        $passenger->load(['program', 'payments', 'contracts']);

        return Inertia::render('Ecommerce/Confirmation', [
            'passenger' => $passenger
        ]);
    }

    /**
     * Buscar reserva por email y número de documento
     */
    public function searchReservation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'document_number' => 'required|string'
        ]);

        $passenger = Passenger::with(['program', 'payments', 'contracts'])
                             ->where('email', $request->email)
                             ->where('document_number', $request->document_number)
                             ->first();

        if (!$passenger) {
            return back()->with('error', 'No se encontró ninguna reserva con esos datos.');
        }

        return Inertia::render('Ecommerce/ReservationDetail', [
            'passenger' => $passenger
        ]);
    }

    /**
     * Página de búsqueda de reservas
     */
    public function findReservation()
    {
        return Inertia::render('Ecommerce/FindReservation');
    }

    /**
     * Crear un pago
     */
    private function createPayment($passenger, $amount, $installmentNumber, $totalInstallments, $gateway)
    {
        return Payment::create([
            'passenger_id' => $passenger->id,
            'amount' => $amount,
            'payment_date' => null,
            'payment_method' => 'online',
            'gateway' => $gateway,
            'status' => 'pending',
            'installment_number' => $installmentNumber,
            'total_installments' => $totalInstallments,
            'due_date' => $installmentNumber === 1 ? now()->addDays(1) : now()->addDays(30 * $installmentNumber)
        ]);
    }
}
