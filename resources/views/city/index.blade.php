@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <class class="row">
                    <div class="col-md-11">
                        <h3 style="color: white;">Cities</h3>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('city.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
                    </div>
                </class>
            </div>
            <div class="card-body">

                <form action="{{ route('city.index') }}" class="navbar-search" method="GET">

                    <div class="row mt-3">
                        <div class="col md-auto">

                            <select name="records_per_page" class="form-select bg-light border-0 small" value="{{ $data->records_per_page }}">
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
                                       placeholder="Buscar..."
                                       aria-label="seach"
                                       name="filter"
                                       value="{{ $data-> filter }}">
                            </div>
                        </div>

                        <div class="col-md-auto">
                            <div class="input-group-mb-3">
                                <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                            </div>
                        </div>

                    </div>

                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($city as $cit)

                            <tr>
                                <td>{{ $cit->id }}</td>
                                <td>{{ $cit->name }}</td>
                                <td>
                                    <a href="{{ route('city.edit', $cit->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>

                                    <form action="{{ route('city.delete', $cit->id) }}" style="display: contents;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btnDelete"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

                {{ $city->appends(request()->except('page'))->links('components.customPagination') }}

            </div>
        </div>
    </section>

@endsection

<script type="module">

    $(document).ready(function() {

        $('.btnDelete').click(function (event) {

            event.preventDefault();

            Swal.fire({
                title: "!Hold on¡",
                text: "¿Do you really want to delete the city?",
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
