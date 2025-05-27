<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with(['commercialExecutive', 'passengers'])
            ->paginate(10);

        return Inertia::render('Admin/Programs/Index', [
            'programs' => $programs
        ]);
    }

    public function create()
    {
        $executives = User::where('role', 'executive')->get();
        
        return Inertia::render('Admin/Programs/Create', [
            'executives' => $executives
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_number' => 'required|string|unique:programs',
            'max_passengers' => 'required|integer|min:1',
            'description' => 'required|string',
            'commercial_executive_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'service_type' => 'required|in:same_year,reservation',
            'status' => 'required|in:active,inactive,completed',
            'price_per_passenger' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $program = Program::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Programa creado exitosamente.');
    }

    public function show(Program $program)
    {
        $program->load(['commercialExecutive', 'passengers.payments']);
        
        return Inertia::render('Admin/Programs/Show', [
            'program' => $program
        ]);
    }

    public function edit(Program $program)
    {
        $executives = User::where('role', 'executive')->get();
        
        return Inertia::render('Admin/Programs/Edit', [
            'program' => $program,
            'executives' => $executives
        ]);
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'program_number' => 'required|string|unique:programs,program_number,' . $program->id,
            'max_passengers' => 'required|integer|min:1',
            'description' => 'required|string',
            'commercial_executive_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'service_type' => 'required|in:same_year,reservation',
            'status' => 'required|in:active,inactive,completed',
            'price_per_passenger' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Programa actualizado exitosamente.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Programa eliminado exitosamente.');
    }

    public function updatePrice(Request $request, Program $program)
    {
        $validated = $request->validate([
            'new_price' => 'required|numeric|min:0',
            'adjustment_reason' => 'required|string'
        ]);

        // Actualizar precio base del programa
        $oldPrice = $program->price_per_passenger;
        $program->update(['price_per_passenger' => $validated['new_price']]);

        // Aplicar ajuste a todos los pasajeros
        $adjustment = $validated['new_price'] - $oldPrice;
        
        $program->passengers()->update([
            'price_adjustments' => \DB::raw('price_adjustments + ' . $adjustment),
            'adjustment_reason' => $validated['adjustment_reason']
        ]);

        return back()->with('success', 'Precio actualizado para todo el grupo.');
    }
}
