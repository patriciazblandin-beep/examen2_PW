@extends('layouts.admin')

@section('titulo', 'Registrar Colaborador')

@section('contenido')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1 class="h3 mb-0 fw-bold"><i class="fas fa-user-plus text-success me-2"></i>Registrar Nuevo Colaborador</h1>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Volver</a>
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
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Identidad / DNI (13 dígitos, sin guiones) *</label>
                        <input type="text" name="identidad" class="form-control" maxlength="13" value="{{ old('identidad') }}" placeholder="0801199912345" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Nombre *</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" placeholder="Ej: Juan Carlos" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Apellido *</label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" placeholder="Ej: Gómez Pérez" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Correo Electrónico *</label>
                        <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" placeholder="Ej: jgomez@agrovalle.hn" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Cargo Desempeñado *</label>
                        <select name="cargo" class="form-select" required>
                            <option value="">Seleccione el cargo...</option>
                            @foreach([
                                'Ingeniero Agrónomo', 
                                'Asesor Técnico de Campo', 
                                'Jefe de Bodega Central', 
                                'Operador de Maquinaria', 
                                'Cajero'
                            ] as $c)
                                <option value="{{ $c }}" {{ old('cargo') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Salario Base Mensual (L.) *</label>
                        <input type="number" step="0.01" min="0.01" name="salario" class="form-control" value="{{ old('salario') }}" placeholder="0.00" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fecha de Ingreso *</label>
                        <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Estado *</label>
                        <select name="estado" class="form-select" required>
                            <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('empleados.index') }}" class="btn btn-light border me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-1"></i> Guardar Colaborador</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection