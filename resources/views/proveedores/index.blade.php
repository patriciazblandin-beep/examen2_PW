@extends('layouts.admin')

@section('titulo', 'Proveedores Agrícolas')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-truck-field text-success me-2"></i>Fabricantes y Proveedores Agrícolas
            </h1>
            <p class="text-muted small mb-0">Gestión de alianzas comerciales y líneas de crédito - Agrovalle Honduras</p>
        </div>
        <a href="{{ route('proveedores.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nuevo Proveedor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <form action="{{ route('proveedores.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Buscar por empresa o RTN (14 dígitos)..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @if(request('search'))
                        <a href="{{ route('proveedores.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>RTN</th>
                            <th>Empresa / Contacto</th>
                            <th>Categoría</th>
                            <th>Teléfono</th>
                            <th class="text-end">Límite de Crédito</th>
                            <th class="text-center">Plazo</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proveedores as $prov)
                            <tr>
                                <td class="fw-bold text-primary">{{ $prov->rtn }}</td>
                                <td>
                                    <div class="fw-bold">{{ $prov->empresa }}</div>
                                    <small class="text-muted"><i class="fas fa-user-tie me-1"></i>{{ $prov->contacto }}</small>
                                </td>
                                <td><span class="badge bg-secondary">{{ $prov->categoria }}</span></td>
                                <td><i class="fas fa-phone-alt text-muted me-1"></i>{{ $prov->telefono }}</td>
                                <td class="text-end fw-bold text-success">L. {{ number_format($prov->limite_credito, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark">{{ $prov->dias_credito }} días</span>
                                </td>
                                <td class="text-center">
                                    @if($prov->estado == 'Activo')
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Activo</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-ban me-1"></i>Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('proveedores.edit', $prov->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('proveedores.destroy', $prov->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Está seguro de eliminar al proveedor {{ $prov->empresa }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fas fa-truck fa-2x mb-2 d-block"></i> No hay proveedores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($proveedores->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <small class="text-muted">Mostrando {{ $proveedores->firstItem() }} a {{ $proveedores->lastItem() }} de {{ $proveedores->total() }} registros</small>
                <div>{{ $proveedores->withQueryString()->links() }}</div>
            </div>
        @endif
    </div>
</div>
@endsection