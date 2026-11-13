<?php

namespace App\Http\Controllers;

use App\Models\empleados;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadosController extends Controller
{
    public function index(Request $request)
    {
        $query = empleados::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('identidad', 'LIKE', "%{$search}%");
        }

        $empleados = $query->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identidad' => 'required|digits:13|unique:empleados,identidad',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:empleados,correo',
            'cargo' => 'required|in:Ingeniero Agrónomo,Asesor Técnico de Campo,Jefe de Bodega Central,Operador de Maquinaria,Cajero',
            'salario' => 'required|numeric|min:0.01',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        empleados::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Colaborador registrado correctamente en el sistema.');
    }

    public function show(empleados $empleados)
    {
        return redirect()->route('empleados.index');
    }

    public function edit(empleados $empleados)
    {
        return view('empleados.edit', compact('empleados'));
    }

    public function update(Request $request, empleados $empleados)
    {
        $request->validate([
            'identidad' => ['required', 'digits:13', Rule::unique('empleados', 'identidad')->ignore($empleados->id)],
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => ['required', 'email', Rule::unique('empleados', 'correo')->ignore($empleados->id)],
            'cargo' => 'required|in:Ingeniero Agrónomo,Asesor Técnico de Campo,Jefe de Bodega Central,Operador de Maquinaria,Cajero',
            'salario' => 'required|numeric|min:0.01',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $empleados->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Información del colaborador actualizada exitosamente.');
    }

    public function destroy(empleados $empleados)
    {
        $empleados->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Colaborador eliminado del sistema.');
    }
}