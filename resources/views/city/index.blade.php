@extends('layouts.app')

@section('content')

    <section id="hero" class="hero section dark-background">
        <div class="card">
            <div class="card-header">
                <class class="row">
                    <div class="col-md-11">
                        <h3>Cities</h3>
                    </div>
                    <div class="col-md-1">
                        <a href="" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
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
                        @foreach ($city as $cit)

                            <tr>
                                <td>{{ $cit->id }}</td>
                                <td>{{ $cit->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="#" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
