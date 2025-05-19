@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Update Permission</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('permission.update') }}" class="row g-3" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $permission->id }}" />

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the permission name..." name="name" value="{{ $permission->name }}" />
                        <label>Name</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the description..." name="description" value="{{ $permission->description }}" />
                        <label>Description</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the module..." name="module" value="{{ $permission->module }}" />
                        <label>Module</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary">Go back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
