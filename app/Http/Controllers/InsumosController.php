<?php

namespace App\Http\Controllers;

use App\Models\insumos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InsumosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = insumos::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('codigo', 'LIKE', "%{$search}%");
        }

        $insumos = $query->paginate(10);
        return view('insumos.index', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('insumos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:insumos,codigo',
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Fertilizantes,Semillas Certificadas,Agroquímicos,Herramientas,Sistemas de Riego',
            'precio' => 'required|numeric|gt:0',
            'costo' => 'required|numeric|min:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'Fabricante' => 'required|string|max:255',
            'fecha_Vencimiento' => 'nullable|date',
            'Fecha_registro' => 'required|date',
            'numero_de_lote' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/insumos'), $filename);
            $data['imagen'] = 'uploads/insumos/' . $filename;
        }

        insumos::create($data);

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo agropecuario registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(insumos $insumo)
    {
        return redirect()->route('insumos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(insumos $insumo)
    {
        return view('insumos.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, insumos $insumo)
    {
        $request->validate([
            'codigo' => ['required', 'string', Rule::unique('insumos', 'codigo')->ignore($insumo->id)],
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Fertilizantes,Semillas Certificadas,Agroquímicos,Herramientas,Sistemas de Riego',
            'precio' => 'required|numeric|gt:0',
            'costo' => 'required|numeric|min:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'Fabricante' => 'required|string|max:255',
            'fecha_Vencimiento' => 'nullable|date',
            'Fecha_registro' => 'required|date',
            'numero_de_lote' => 'required|string|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($insumo->imagen && file_exists(public_path($insumo->imagen))) {
                @unlink(public_path($insumo->imagen));
            }

            $file = $request->file('imagen');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/insumos'), $filename);
            $data['imagen'] = 'uploads/insumos/' . $filename;
        }

        $insumo->update($data);

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(insumos $insumo)
    {
        if ($insumo->imagen && file_exists(public_path($insumo->imagen))) {
            @unlink(public_path($insumo->imagen));
        }

        $insumo->delete();

        return redirect()->route('insumos.index')
            ->with('success', 'Insumo eliminado del sistema.');
    }
}