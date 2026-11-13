@extends('layouts.admin')

@section('titulo', 'Registrar Nuevo Insumo')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="h3 mb-0 fw-bold"><i class="fas fa-plus-circle text-success me-2"></i>Registrar Nuevo Insumo</h1>
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
            <form action="{{ route('insumos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Código SKU -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Código (SKU Único) *</label>
                        <input type="text" name="codigo" class="form-control" value="{{ old('codigo') }}" placeholder="Ej: FERT-001" required>
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Nombre del Insumo *</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Fertilizante Urea 46%" required>
                    </div>

                    <!-- Categoría -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Categoría *</label>
                        <select name="categoria" class="form-select" required>
                            <option value="">Seleccione una categoría...</option>
                            @foreach(['Fertilizantes', 'Semillas Certificadas', 'Agroquímicos', 'Herramientas', 'Sistemas de Riego'] as $cat)
                                <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Fabricante -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fabricante / Marca *</label>
                        <input type="text" name="Fabricante" class="form-control" value="{{ old('Fabricante') }}" placeholder="Ej: Bayer / Yara" required>
                    </div>

                    <!-- Número de Lote -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Número de Lote *</label>
                        <input type="text" name="numero_de_lote" class="form-control" value="{{ old('numero_de_lote') }}" placeholder="Ej: LOTE-2026-A" required>
                    </div>

                    <!-- Precio Venta -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Precio de Venta (L.) *</label>
                        <input type="number" step="0.01" min="0.01" name="precio" class="form-control" value="{{ old('precio') }}" placeholder="0.00" required>
                    </div>

                    <!-- Costo -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Costo Unitario (L.) *</label>
                        <input type="number" step="0.01" min="0" name="costo" class="form-control" value="{{ old('costo') }}" placeholder="0.00" required>
                    </div>

                    <!-- Inventario -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Inventario Inicial (Unidades) *</label>
                        <input type="number" min="0" name="inventario" class="form-control" value="{{ old('inventario', 0) }}" required>
                    </div>

                    <!-- Fecha de Registro -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Registro *</label>
                        <input type="date" name="Fecha_registro" class="form-control" value="{{ old('Fecha_registro', date('Y-m-d')) }}" required>
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Vencimiento (Opcional)</label>
                        <input type="date" name="fecha_Vencimiento" class="form-control" value="{{ old('fecha_Vencimiento') }}">
                    </div>

                    <!-- Fotografía del Empaque -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fotografía del Empaque (JPG, PNG, WEBP - Máx 5MB)</label>
                        <input type="file" name="imagen" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('insumos.index') }}" class="btn btn-light border me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Guardar Insumo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsectionS