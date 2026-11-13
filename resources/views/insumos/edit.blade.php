@extends('layouts.admin')

@section('titulo', 'Editar Insumo')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="h3 mb-0 fw-bold"><i class="fas fa-edit text-primary me-2"></i>Editar Insumo: {{ $insumo->nombre }}</h1>
        <a href="{{ route('insumos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver al Catálogo
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong><i class="fas fa-exclamation-triangle me-1"></i>Por favor corrige los siguientes errores:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('insumos.update', $insumo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Código SKU -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Código (SKU Único) *</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo', $insumo->codigo) }}" required>
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Nombre del Insumo *</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $insumo->nombre) }}" required>
                    </div>

                    <!-- Categoría -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Categoría *</label>
                        <select name="categoria" class="form-select" required>
                            @foreach(['Fertilizantes', 'Semillas Certificadas', 'Agroquímicos', 'Herramientas', 'Sistemas de Riego'] as $cat)
                                <option value="{{ $cat }}" {{ old('categoria', $insumo->categoria) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fabricante -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fabricante / Marca *</label>
                        <input type="text" name="Fabricante" class="form-control" value="{{ old('Fabricante', $insumo->Fabricante) }}" required>
                    </div>

                    <!-- Número de Lote -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Número de Lote *</label>
                        <input type="text" name="numero_de_lote" class="form-control" value="{{ old('numero_de_lote', $insumo->numero_de_lote) }}" required>
                    </div>

                    <!-- Precio Venta -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Precio de Venta (L.) *</label>
                        <input type="number" step="0.01" min="0.01" name="precio" class="form-control" value="{{ old('precio', $insumo->precio) }}" required>
                    </div>

                    <!-- Costo -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Costo Unitario (L.) *</label>
                        <input type="number" step="0.01" min="0" name="costo" class="form-control" value="{{ old('costo', $insumo->costo) }}" required>
                    </div>

                    <!-- Inventario -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Inventario Actual (Unidades) *</label>
                        <input type="number" min="0" name="inventario" class="form-control" value="{{ old('inventario', $insumo->inventario) }}" required>
                    </div>

                    <!-- Fecha de Registro -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Registro *</label>
                        <input type="date" name="Fecha_registro" class="form-control" value="{{ old('Fecha_registro', $insumo->Fecha_registro) }}" required>
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Vencimiento (Opcional)</label>
                        <input type="date" name="fecha_Vencimiento" class="form-control" value="{{ old('fecha_Vencimiento', $insumo->fecha_Vencimiento) }}">
                    </div>

                    <!-- Fotografía del Empaque -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Cambiar Fotografía (Opcional)</label>
                        <input type="file" name="imagen" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        @if($insumo->imagen)
                            <div class="mt-2 d-flex align-items-center">
                                <img src="{{ asset($insumo->imagen) }}" alt="Actual" class="rounded border me-2" style="width: 45px; height: 45px; object-fit: cover;">
                                <small class="text-muted">Imagen actual cargada</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('insumos.index') }}" class="btn btn-light border me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-sync-alt me-1"></i> Actualizar Insumo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection