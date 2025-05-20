@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">New Show</h3>
        </div>
        <div class="card-body mt-3">
            <form action="{{ route('show.store') }}" class="row g-3" method="POST">
                @csrf

                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="room_id" class="form-select" required>
                            <option value="">Select a Room</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->room_id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <label>Room</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="movie_id" class="form-select" required>
                            <option value="">Select a Movie</option>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->movie_id }}">{{ $movie->title }}</option>
                            @endforeach
                        </select>
                        <label>Movie</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" name="date" class="form-control" required>
                        <label>Date</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="time" name="time" class="form-control" required>
                        <label>Time</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" name="price" class="form-control" placeholder="Enter price..." required>
                        <label>Price</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <select name="worker_id" class="form-select">
                            <option value="">Optional: Select a Worker</option>
                            @foreach($workers as $worker)
                                <option value="{{ $worker->worker_id }}">{{ $worker->name }}</option>
                            @endforeach
                        </select>
                        <label>Worker</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" name="active" id="active" checked>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('show.index') }}" class="btn btn-secondary">Go back</a>
                </div>

            </form>
        </div>
    </div>
</section>

@endsection
