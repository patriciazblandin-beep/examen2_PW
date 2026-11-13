@extends('layouts.admin')

@section('titulo', 'Catálogo de Insumos Agropecuarios')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-seedling text-success me-2"></i>Catálogo de Insumos Agropecuarios
            </h1>
            <p class="text-muted small mb-0">Control de inventario, lotes y existencias - Agrovalle Honduras</p>
        </div>
        <a href="{{ route('insumos.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nuevo Insumo
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
            <!-- Buscador por Nombre o SKU -->
            <form action="{{ route('insumos.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Buscar por nombre del insumo o código SKU..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    @if(request('search'))
                        <a href="{{ route('insumos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Imagen</th>
                            <th>Código (SKU)</th>
                            <th>Nombre / Fabricante</th>
                            <th>Categoría</th>
                            <th>Lote / Vencimiento</th>
                            <th class="text-end">Precio / Costo</th>
                            <th class="text-center">Existencias</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($insumos as $insumo)
                            <tr>
                                <!-- Miniatura de Foto -->
                                <td class="text-center">
                                    @if($insumo->imagen)
                                        <img src="{{ asset($insumo->imagen) }}" alt="{{ $insumo->nombre }}" 
                                             class="rounded border shadow-sm" 
                                             style="width: 55px; height: 55px; object-fit: cover;">
                                    @else
                                        <div class="bg-light border rounded d-inline-flex align-items-center justify-content-center text-muted" 
                                             style="width: 55px; height: 55px;">
                                            <i class="fas fa-box-open fa-lg"></i>
                                        </div>
                                    @endif
                                </td>

                                <td class="fw-bold text-primary">{{ $insumo->codigo }}</td>

                                <td>
                                    <div class="fw-bold">{{ $insumo->nombre }}</div>
                                    <small class="text-muted"><i class="fas fa-industry me-1"></i>{{ $insumo->Fabricante }}</small>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">{{ $insumo->categoria }}</span>
                                </td>

                                <td>
                                    <div class="small"><strong>Lote:</strong> {{ $insumo->numero_de_lote }}</div>
                                    <div class="small text-muted">
                                        <strong>Vence:</strong> {{ $insumo->fecha_Vencimiento ?? 'No aplica' }}
                                    </div>
                                </td>

                                <td class="text-end">
                                    <div class="fw-bold text-success">L. {{ number_format($insumo->precio, 2) }}</div>
                                    <small class="text-muted">Costo: L. {{ number_format($insumo->costo, 2) }}</small>
                                </td>

                                <!-- Badges Semánticos de Existencias -->
                                <td class="text-center">
                                    <div class="fw-bold fs-6 mb-1">{{ $insumo->inventario }} uds.</div>
                                    @if($insumo->inventario > 20)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Óptimo
                                        </span>
                                    @elseif($insumo->inventario >= 10)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-exclamation-circle me-1"></i>Moderado
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-exclamation-triangle me-1"></i>¡Desabastecimiento!
                                        </span>
                                    @endif
                                </td>

                                <!-- Acciones -->
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('insumos.edit', $insumo->id) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('insumos.destroy', $insumo->id) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar el insumo {{ $insumo->nombre }} ({{ $insumo->codigo }})? Esta acción no se puede deshacer.');">
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
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No se encontraron insumos registrados en el inventario.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación con links() -->
        @if($insumos->hasPages())
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Mostrando {{ $insumos->firstItem() }} a {{ $insumos->lastItem() }} de {{ $insumos->total() }} registros
                </small>
                <div>
                    {{ $insumos->withQueryString()->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection