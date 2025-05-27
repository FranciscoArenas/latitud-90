<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Passenger;
use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Fechas por defecto (último mes)
        $dateFrom = $request->date_from ?? Carbon::now()->subMonth()->format('Y-m-d');
        $dateTo = $request->date_to ?? Carbon::now()->format('Y-m-d');
        $programId = $request->program;

        // Consulta base con filtros
        $paymentsQuery = Payment::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'approved');

        $passengersQuery = Passenger::whereBetween('created_at', [$dateFrom, $dateTo]);

        if ($programId) {
            $paymentsQuery->whereHas('passenger', function($q) use ($programId) {
                $q->where('program_id', $programId);
            });
            $passengersQuery->where('program_id', $programId);
        }

        // Estadísticas principales
        $totalRevenue = $paymentsQuery->sum('amount');
        $totalReservations = $passengersQuery->count();
        $totalVisitors = $passengersQuery->count(); // Simplificado, podría ser más complejo
        $conversionRate = $totalVisitors > 0 ? round(($totalReservations / $totalVisitors) * 100, 2) : 0;
        $averageOrderValue = $totalReservations > 0 ? round($totalRevenue / $totalReservations, 2) : 0;

        // Programas más populares
        $popularPrograms = Program::withCount(['passengers' => function($q) use ($dateFrom, $dateTo) {
                $q->whereBetween('created_at', [$dateFrom, $dateTo]);
            }])
            ->with(['passengers' => function($q) use ($dateFrom, $dateTo) {
                $q->whereBetween('created_at', [$dateFrom, $dateTo])
                  ->with(['payments' => function($pq) {
                      $pq->where('status', 'approved');
                  }]);
            }])
            ->orderBy('passengers_count', 'desc')
            ->limit(5)
            ->get()
            ->map(function($program) {
                $totalRevenue = $program->passengers->sum(function($passenger) {
                    return $passenger->payments->sum('amount');
                });
                
                return [
                    'id' => $program->id,
                    'title' => $program->title,
                    'reservations_count' => $program->passengers_count,
                    'total_revenue' => $totalRevenue
                ];
            });

        // Métodos de pago
        $paymentMethods = Payment::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'approved')
            ->selectRaw('payment_method as gateway, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->map(function($item) use ($totalRevenue) {
                return [
                    'gateway' => $item->gateway ?? 'unknown',
                    'count' => $item->count,
                    'total' => $item->total,
                    'percentage' => $totalRevenue > 0 ? round(($item->total / $totalRevenue) * 100, 2) : 0
                ];
            });

        // Datos del reporte
        $reportData = [
            'totalRevenue' => $totalRevenue,
            'totalReservations' => $totalReservations,
            'conversionRate' => $conversionRate,
            'averageOrderValue' => $averageOrderValue,
            'popularPrograms' => $popularPrograms,
            'paymentMethods' => $paymentMethods
        ];

        // Lista de programas para el filtro
        $programs = Program::select('id', 'title')->get();

        return Inertia::render('Admin/Reports/Index', [
            'reportData' => $reportData,
            'programs' => $programs,
            'filters' => [
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'program' => $programId
            ]
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->format ?? 'csv';
        $dateFrom = $request->date_from ?? Carbon::now()->subMonth()->format('Y-m-d');
        $dateTo = $request->date_to ?? Carbon::now()->format('Y-m-d');
        $programId = $request->program;

        // Obtener datos
        $query = Payment::with(['passenger.program'])
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'approved');

        if ($programId) {
            $query->whereHas('passenger', function($q) use ($programId) {
                $q->where('program_id', $programId);
            });
        }

        $payments = $query->get();

        switch ($format) {
            case 'csv':
                return $this->exportCSV($payments, $dateFrom, $dateTo);
            case 'excel':
                return $this->exportExcel($payments, $dateFrom, $dateTo);
            case 'pdf':
                return $this->exportPDF($payments, $dateFrom, $dateTo);
            default:
                return $this->exportCSV($payments, $dateFrom, $dateTo);
        }
    }

    private function exportCSV($payments, $dateFrom, $dateTo)
    {
        $filename = "reporte_ventas_{$dateFrom}_a_{$dateTo}.csv";
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            
            // Encabezados CSV
            fputcsv($file, [
                'Fecha', 'ID Pago', 'Pasajero', 'Email', 'Programa', 
                'Método Pago', 'Monto', 'Estado'
            ]);

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->created_at->format('Y-m-d'),
                    $payment->id,
                    $payment->passenger->first_name . ' ' . $payment->passenger->last_name,
                    $payment->passenger->email,
                    $payment->passenger->program->title,
                    $payment->payment_method,
                    $payment->amount,
                    $payment->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportExcel($payments, $dateFrom, $dateTo)
    {
        // Implementar exportación a Excel usando Laravel Excel
        // return Excel::download(new PaymentsExport($payments), "reporte_ventas_{$dateFrom}_a_{$dateTo}.xlsx");
        
        // Por ahora, devolver CSV como fallback
        return $this->exportCSV($payments, $dateFrom, $dateTo);
    }

    private function exportPDF($payments, $dateFrom, $dateTo)
    {
        // Implementar exportación a PDF
        // $pdf = PDF::loadView('admin.reports.pdf', compact('payments', 'dateFrom', 'dateTo'));
        // return $pdf->download("reporte_ventas_{$dateFrom}_a_{$dateTo}.pdf");
        
        // Por ahora, devolver CSV como fallback
        return $this->exportCSV($payments, $dateFrom, $dateTo);
    }

    public function salesChart(Request $request)
    {
        $period = $request->period ?? 'daily';
        $dateFrom = $request->date_from ?? Carbon::now()->subMonth()->format('Y-m-d');
        $dateTo = $request->date_to ?? Carbon::now()->format('Y-m-d');

        $query = Payment::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'approved');

        switch ($period) {
            case 'daily':
                $data = $query->selectRaw('DATE(created_at) as date, SUM(amount) as total, COUNT(*) as count')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
                break;
            case 'weekly':
                $data = $query->selectRaw('YEARWEEK(created_at) as week, SUM(amount) as total, COUNT(*) as count')
                    ->groupBy('week')
                    ->orderBy('week')
                    ->get();
                break;
            case 'monthly':
                $data = $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total, COUNT(*) as count')
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
                break;
            default:
                $data = collect();
        }

        return response()->json($data);
    }
}
