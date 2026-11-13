@extends('layouts.admin')

@section('titulo', 'Personal y Nómina')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-users text-success me-2"></i>Recursos Humanos y Personal Técnico
            </h1>
            <p class="text-muted small mb-0">Control de nómina, colaboradores y asignaciones - Agrovalle Honduras</p>
        </div>
        <a href="{{ route('empleados.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-user-plus me-1"></i> Nuevo Colaborador
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
            <form action="{{ route('empleados.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Buscar por nombre, apellido o identidad..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @if(request('search'))
                        <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Identidad (DNI)</th>
                            <th>Colaborador</th>
                            <th>Cargo</th>
                            <th class="text-end">Salario Base</th>
                            <th class="text-center">Ingreso</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($empleados as $emp)
                            <tr>
                                <td class="fw-bold text-primary">{{ $emp->identidad }}</td>
                                <td>
                                    <div class="fw-bold">{{ $emp->nombre }} {{ $emp->apellido }}</div>
                                    <small class="text-muted"><i class="fas fa-envelope me-1"></i>{{ $emp->correo }}</small>
                                </td>
                                <td><span class="badge bg-secondary">{{ $emp->cargo }}</span></td>
                                <td class="text-end fw-bold text-success">L. {{ number_format($emp->salario, 2) }}</td>
                                <td class="text-center small">{{ \Carbon\Carbon::parse($emp->fecha_ingreso)->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @if($emp->estado == 'Activo')
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Activo</span>
                                    @else
                                        <span class="badge bg-secondary"><i class="fas fa-ban me-1"></i>Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('empleados.edit', $emp->id) }}" class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('empleados.destroy', $emp->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Está seguro de eliminar al colaborador {{ $emp->nombre }} {{ $emp->apellido }}?');">
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
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-users-slash fa-2x mb-2 d-block"></i> No hay colaboradores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($empleados->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <small class="text-muted">Mostrando {{ $empleados->firstItem() }} a {{ $empleados->lastItem() }} de {{ $empleados->total() }} registros</small>
                <div>{{ $empleados->withQueryString()->links() }}</div>
            </div>
        @endif
    </div>
</div>
@endsection