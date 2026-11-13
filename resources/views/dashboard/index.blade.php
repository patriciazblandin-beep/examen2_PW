@extends('layouts.admin')

@section('titulo', 'Dashboard Gerencial')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-chart-line text-success me-2"></i>Dashboard Gerencial - Agrovalle Honduras
            </h1>
            <p class="text-muted small mb-0">Indicadores clave de rendimiento (KPIs) estadísticos en tiempo real</p>
        </div>
    </div>

    <!-- Fila de Tarjetas de Indicadores Clave (KPIs) -->
    <div class="row g-4 mb-4">
        
        <!-- Tarjeta 1: Total de Insumos -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-primary border-4 py-2 h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Insumos en Catálogo</div>
                            <div class="h3 mb-0 fw-bold text-gray-800">{{ $totalInsumos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Proveedores Activos -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-success border-4 py-2 h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Proveedores Activos</div>
                            <div class="h3 mb-0 fw-bold text-gray-800">{{ $proveedoresActivos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-field fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3: Empleados en Nómina -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-info border-4 py-2 h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">Empleados en Nómina</div>
                            <div class="h3 mb-0 fw-bold text-gray-800">{{ $totalEmpleados }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 4: Valor Total del Inventario Agrícola -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm border-start border-warning border-4 py-2 h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Valor Total Inventario</div>
                            <div class="h4 mb-0 fw-bold text-gray-800">L. {{ number_format($valorInventario, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Sección de Accesos Directos -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4 text-center">
                    <i class="fas fa-seedling text-success fa-3x mb-3"></i>
                    <h4 class="fw-bold">Bienvenida al Sistema de Gestión Agrovalle Honduras</h4>
                    <p class="text-muted">Utiliza el menú lateral para navegar entre los módulos de Insumos, Proveedores y Recursos Humanos.</p>
                    <div class="mt-3">
                        <a href="{{ route('insumos.index') }}" class="btn btn-outline-primary m-1"><i class="fas fa-boxes me-1"></i> Ir a Insumos</a>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-success m-1"><i class="fas fa-truck me-1"></i> Ir a Proveedores</a>
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-info m-1"><i class="fas fa-users me-1"></i> Ir a Empleados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection