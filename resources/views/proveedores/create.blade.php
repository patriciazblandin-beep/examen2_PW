@extends('layouts.admin')

@section('titulo', 'Registrar Proveedor')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="h3 mb-0 fw-bold"><i class="fas fa-plus-circle text-success me-2"></i>Registrar Nuevo Proveedor</h1>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Volver</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong><i class="fas fa-exclamation-triangle me-1"></i>Corrige los siguientes errores:</strong>
            <ul class="mb-0 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">RTN (14 dígitos) *</label>
                        <input type="text" name="rtn" class="form-control" maxlength="14" value="{{ old('rtn') }}" placeholder="08011999123456" required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold">Empresa (Razón Social) *</label>
                        <input type="text" name="empresa" class="form-control" value="{{ old('empresa') }}" placeholder="Ej: Agroquímicos de Honduras S.A." required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Contacto (Asesor Comercial) *</label>
                        <input type="text" name="contacto" class="form-control" value="{{ old('contacto') }}" placeholder="Ej: Ing. Carlos Pérez" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Teléfono (8 dígitos) *</label>
                        <input type="text" name="telefono" class="form-control" maxlength="8" value="{{ old('telefono') }}" placeholder="Ej: 98765432" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Categoría *</label>
                        <select name="categoria" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach(['Químicos', 'Semilleros', 'Maquinaria'] as $cat)
                                <option value="{{ $cat }}" {{ old('categoria') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Límite de Crédito (L.) *</label>
                        <input type="number" step="0.01" min="0" name="limite_credito" class="form-control" value="{{ old('limite_credito') }}" placeholder="0.00" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Días de Crédito *</label>
                        <select name="dias_credito" class="form-select" required>
                            <option value="">Seleccione plazo...</option>
                            @foreach([15, 30, 45, 60] as $dias)
                                <option value="{{ $dias }}" {{ old('dias_credito') == $dias ? 'selected' : '' }}>{{ $dias }} días</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estado *</label>
                        <select name="estado" class="form-select" required>
                            <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Registro *</label>
                        <input type="date" name="fecha_registro" class="form-control" value="{{ old('fecha_registro', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-light border me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-1"></i> Guardar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection