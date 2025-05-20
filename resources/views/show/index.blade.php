@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <div class="row">
                <div class="col-md-11">
                    <h3 style="color: white;">Shows</h3>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('show.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('show.index') }}" method="GET" class="navbar-search">

                <div class="row mt-3">
                    <div class="col md-auto">
                        <select name="records_per_page" class="form-select bg-light border-0 small">
                            <option value="2" {{ $data->records_per_page == 2 ? 'selected' : ''}}>2</option>
                            <option value="10" {{ $data->records_per_page == 10 ? 'selected' : ''}}>10</option>
                            <option value="15" {{ $data->records_per_page == 15 ? 'selected' : ''}}>15</option>
                            <option value="30" {{ $data->records_per_page == 30 ? 'selected' : ''}}>30</option>
                            <option value="50" {{ $data->records_per_page == 50 ? 'selected' : ''}}>50</option>
                        </select>
                    </div>

                    <div class="col-md-10">
                        <div class="input-group-mb-3">
                            <input type="text"
                                   class="form-control bg-light border-0 small"
                                   placeholder="Search by movie title..."
                                   aria-label="search"
                                   name="filter"
                                   value="{{ $data->filter }}">
                        </div>
                    </div>

                    <div class="col-md-auto">
                        <div class="input-group-mb-3">
                            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>

            </form>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Room</th>
                        <th>Movie</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Worker</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shows as $show)
                        <tr>
                            <td>{{ $show->show_id }}</td>
                            <td>{{ $show->room->name ?? 'N/A' }}</td>
                            <td>{{ $show->movie->title ?? 'N/A' }}</td>
                            <td>{{ $show->date }}</td>
                            <td>{{ $show->time }}</td>
                            <td>${{ $show->price }}</td>
                            <td>{{ $show->worker->name ?? 'N/A' }}</td>
                            <td>{{ $show->active ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('show.edit', $show->show_id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>

                                <form action="{{ route('show.delete', $show->show_id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btnDelete"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $shows->appends(request()->except('page'))->links('components.customPagination') }}

        </div>
    </div>
</section>

@endsection

<script type="module">
    $(document).ready(function () {
        $('.btnDelete').click(function (event) {
            event.preventDefault();

            Swal.fire({
                title: "Hold on!",
                text: "Do you really want to delete this show?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#008000",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = $(this).closest('form');
                    form.submit();
                }
            });
        });
    });
</script>
