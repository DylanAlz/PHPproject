@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Update Role</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('role.update') }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="role_id" value="{{ $role->role_id }}" />

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="name" placeholder="Write the role name..." value="{{ old('name', $role->name) }}" />
                        <label>Name</label>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="description" placeholder="Write the description..." value="{{ old('description', $role->description) }}" />
                        <label>Description</label>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('role.index') }}" class="btn btn-secondary">Go back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
