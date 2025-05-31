@extends('layouts.app')
@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Recover Password</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('password.update') }}" class="row g-3" method="POST">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
            


                <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="New Password..." name="password" />
                        <label>New Password</label>
                    </div>
                </div>

                 <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="New Password Confirmation..." name="password_confirmation" />
                        <label>New Password Confirmation</label>
                    </div>
                </div>

                 <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Go back</a>  
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
