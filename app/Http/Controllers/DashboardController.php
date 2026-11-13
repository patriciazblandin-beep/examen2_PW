<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\insumos;
use App\Models\proveedores;
use App\Models\empleados;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInsumos = insumos::count();

        $proveedoresActivos = proveedores::where('estado', 'Activo')->count();

        $totalEmpleados = empleados::where('estado', 'Activo')->count();

        $valorInventario = insumos::all()->sum(function ($insumo) {
            return ($insumo->inventario ?? 0) * ($insumo->precio ?? 0);
        });

        return view('dashboard.index', compact(
            'totalInsumos', 
            'proveedoresActivos', 
            'totalEmpleados', 
            'valorInventario'
        ));
    }
}