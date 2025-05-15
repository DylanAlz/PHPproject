@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <h3 style="color: white;">New City</h3>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('city.store') }}" class="row g-3" method="POST">
                    @csrf

                    {{-- Campo: nombre de la ciudad --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Write the city..." name="name" required>
                            <label>City</label>
                        </div>
                    </div>

                    {{-- Campo: selección del departamento --}}
                    <div class="col-md-12">
                        <div class="form-floating">
                            <select class="form-select" name="department_id" required>
                                <option value="" disabled selected>Select a department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <label>Department</label>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('city.index') }}" class="btn btn-secondary">Go back</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
