<?php

namespace App\Http\Controllers;

use App\Models\proveedores;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedoresController extends Controller
{
    public function index(Request $request)
    {
        $query = proveedores::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('empresa', 'LIKE', "%{$search}%")
                  ->orWhere('rtn', 'LIKE', "%{$search}%");
        }

        $proveedores = $query->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rtn' => 'required|digits:14|unique:proveedores,rtn',
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'telefono' => ['required', 'digits:8', 'regex:/^[2389][0-9]{7}$/'],
            'categoria' => 'required|in:Químicos,Semilleros,Maquinaria',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito' => 'required|in:15,30,45,60',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ]);

        proveedores::create($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor agrícola registrado correctamente.');
    }

    public function show(proveedores $proveedores)
    {
        return redirect()->route('proveedores.index');
    }

    public function edit(proveedores $proveedores)
    {
        return view('proveedores.edit', compact('proveedores'));
    }

    public function update(Request $request, proveedores $proveedores)
    {
        $request->validate([
            'rtn' => ['required', 'digits:14', Rule::unique('proveedores', 'rtn')->ignore($proveedores->id)],
            'empresa' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'telefono' => ['required', 'digits:8', 'regex:/^[2389][0-9]{7}$/'],
            'categoria' => 'required|in:Químicos,Semilleros,Maquinaria',
            'limite_credito' => 'required|numeric|min:0',
            'dias_credito' => 'required|in:15,30,45,60',
            'estado' => 'required|in:Activo,Inactivo',
            'fecha_registro' => 'required|date',
        ]);

        $proveedores->update($request->all());

        return redirect()->route('proveedores.index')
            ->with('success', 'Información del proveedor actualizada exitosamente.');
    }

    public function destroy(proveedores $proveedores)
    {
        $proveedores->delete();

        return redirect()->route('proveedores.index')
            ->with('success', 'Proveedor eliminado del sistema.');
    }
}