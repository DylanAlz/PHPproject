@extends('layouts.app')
@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Change Password</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('profile.updatePassword') }}" class="row g-3" method="POST">
                @method('PATCH')
                @csrf
                

                <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="Current Password..." name="current_password" />
                        <label>Current Password</label>
                    </div>
                </div>

                <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="New Password..." name="new_password" />
                        <label>New Password</label>
                    </div>
                </div>

                 <div class="col-md-12"> 
                    <div class="form-floating">
                        <input type="password" class="form-control" placeholder="New Password Confirmation..." name="new_password_confirmation" />
                        <label>New Password Confirmation</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('home.index') }}" class="btn btn-secondary">Go back</a>

                </div>

            </form>
        </div>
    </div>
</section>

@endsection
