@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <h3 style="color: white;">Edit Employee</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('employee.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="Empleado_ID" value="{{ $employee->Empleado_ID }}">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $employee->nombre }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_ingreso" class="form-label">Entry Date</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="{{ $employee->fecha_ingreso }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="salario" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salario" name="salario" value="{{ $employee->salario }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipo_doc_id" class="form-label">Document Type</label>
                            <select class="form-select" id="tipo_doc_id" name="tipo_doc_id" required>
                                <option value="" disabled>Select Document Type</option>
                                @foreach ($documentTypes as $documentType)
                                    <option value="{{ $documentType->type_doc_id }}" {{ $employee->tipo_doc_id == $documentType->type_doc_id ? 'selected' : '' }}>
                                        {{ $documentType->type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cargo_id" class="form-label">Role</label>
                            <select class="form-select" id="cargo_id" name="cargo_id" required>
                                <option value="" disabled>Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $employee->cargo_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jefe_id" class="form-label">Manager</label>
                            <select class="form-select" id="jefe_id" name="jefe_id">
                                <option value="" disabled>Select Manager</option>
                                @foreach ($employees as $manager)
                                    <option value="{{ $manager->Empleado_ID }}" {{ $employee->jefe_id == $manager->Empleado_ID ? 'selected' : '' }}>
                                        {{ $manager->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="activo" class="form-label">Active</label>
                            <select class="form-select" id="activo" name="activo" required>
                                <option value="1" {{ $employee->activo ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$employee->activo ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="bit_usuario" class="form-label">User Bit</label>
                            <select class="form-select" id="bit_usuario" name="bit_usuario" required>
                                <option value="1" {{ $employee->bit_usuario ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$employee->bit_usuario ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection