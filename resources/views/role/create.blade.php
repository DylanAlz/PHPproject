@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Create Role</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('role.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="number" class="form-control" name="role_id" placeholder="Write the role ID..." value="{{ old('role_id') }}" />
                        <label>Role ID</label>
                        @error('role_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" placeholder="Write the role name..." value="{{ old('name') }}" />
                        <label>Name</label>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="description" placeholder="Write the description..." value="{{ old('description') }}" />
                        <label>Description</label>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Go back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
