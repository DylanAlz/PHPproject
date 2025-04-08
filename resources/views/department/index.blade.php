@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section dark-background">
        <div class="card">
            <div class="card-header">
                <class class="row">
                    <div class="col-md-11">
                        <h3>Departments</h3>
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('department.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
                    </div>
                </class>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($department as $dep)

                            <tr>
                                <td>{{ $dep->id }}</td>
                                <td>{{ $dep->name }}</td>
                                <td>
                                    <a href="{{ route('department.edit', $dep->id) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>

                                    <form action="{{ route('department.delete', $dep->id) }}" style="display: contents;" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btnDelete"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

<script type="module">

    $(document).ready(function() {

        $('.btnDelete').click(function (event) {

            event.preventDefault();

            Swal.fire({
                title: "!Wait¡",
                text: "¿Do you really want to delete the department?",
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
