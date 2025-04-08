@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section dark-background">
        <div class="card">
            <div class="card-header">
                <h3>New Department</h3>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('department.store') }}" class="row g-3" method="POST">
                    @csrf
                    <div class="col-md12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Write the department..." name="name">
                            <label>Department</label>
                        </div>
                    </div>

                    <div class="text center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('department.index') }}" class="btn btn-secondary">Go back</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
