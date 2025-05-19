@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Create Permission</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('permission.store') }}" class="row g-3" method="POST">
                @csrf

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the permission name..." name="name" value="{{ old('name') }}" />
                        <label>Name</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the description..." name="description" value="{{ old('description') }}" />
                        <label>Description</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder="Write the module..." name="module" value="{{ old('module') }}" />
                        <label>Module</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary">Go back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
