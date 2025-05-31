@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <h3 style="color: white;">Update Genre</h3>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('genre.update') }}" class="row g-3" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="genre_id" value="{{ $genre->genre_id }}" />

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Write the genre..." name="genre_" value="{{ $genre->genre_ }}" required />
                            <label>Genre</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Description..." name="description" value="{{ $genre->description }}" required />
                            <label>Description</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check mt-4">
                            <input type="hidden" name="active" value="0">
                            <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $genre->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('genre.index') }}" class="btn btn-secondary">Go back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
