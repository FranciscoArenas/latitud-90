<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Passenger;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard principal del administrador
     */
    public function dashboard()
    {
        // Estadísticas generales
        $stats = [
            'total_passengers' => Passenger::count(),
            'monthly_revenue' => Payment::where('status', 'completed')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('amount'),
            'active_programs' => Program::where('active', true)->count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];

        // Reservas recientes
        $recentReservations = Passenger::with('program')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Pagos recientes
        $recentPayments = Payment::with('passenger')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'recentReservations' => $recentReservations,
            'recentPayments' => $recentPayments,
        ]);
    }
}
