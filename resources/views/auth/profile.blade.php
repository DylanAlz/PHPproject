@extends('layouts.app')
@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Perfil</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('profile.update') }}" class="row g-3" method="POST">
                @method('PUT')
                @csrf
                

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ $user->email }}" readonly />
                        <label>Email</label>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ $user->document }}" placeholder="Document..." name="document" />
                        <label>Document</label>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ $user->first_name }}" placeholder="Name..." name="first_name" />
                        <label>Name</label>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="text" class="form-control" value="{{ $user->last_name }}" placeholder="Last Name..." name="last_name" />
                        <label>Last Name</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">Go back</a>
                    <a href="{{ route('profile.changePassword') }}" class="btn btn-warning">Change Password</a>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection
