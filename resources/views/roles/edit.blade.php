@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <h3 style="color: white;">Update Role</h3>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('roles.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="role_id" value="{{ $roles->id }}" />

                    <div class="col-md12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Write the role..." name="name" value="{{ $roles->name }}" />
                            <label>Role</label>
                        </div>
                    </div>

                    <div class="text center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Go back</a>
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
