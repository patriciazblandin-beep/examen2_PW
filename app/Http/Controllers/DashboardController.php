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
        // 1. Total de Insumos en Catálogo
        $totalInsumos = insumos::count();

        // 2. Total de Proveedores Activos
        $proveedoresActivos = proveedores::where('estado', 'Activo')->count();

        // 3. Total de Empleados en Nómina
        $totalEmpleados = empleados::where('estado', 'Activo')->count();

        // 4. Valor Total del Inventario Agrícola en Lempiras (suma de stock * precio)
        $valorInventario = insumos::all()->sum(function ($insumo) {
            return ($insumo->stock ?? $insumo->cantidad ?? 0) * ($insumo->precio ?? 0);
        });

        return view('dashboard.index', compact(
            'totalInsumos', 
            'proveedoresActivos', 
            'totalEmpleados', 
            'valorInventario'
        ));
    }
}