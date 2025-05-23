@extends('layouts.app')

@section('content')


<section id="hero" class="hero section">
        <div class="card mx-5 my-5" style="background-color: #cccccc;">
            <div class="card-header" style="background-color: #556270;">
                <h3 style="color: white;">New Role</h3>
            </div>

            {{-- Role --}}
            <div class="card mx5 my5 mb3">
                <div class="card-body mt-3">

                    <form action="{{route('roles.store')}}"  method="POST" id="frmCreate">
                        @csrf

                        <input type="hidden" name="permissions" id="permissions"/>
                        <input type="hidden" name="sections"/>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="name" placeholder="Nombre...">
                                <label>Role</label>
                            </div>
                        </div>


                    </form>

                </div>
            </div>


            {{-- Ciudades --}}
            {{-- <div class="card mx5 my5">
                <div class="card-body mt-3">

                    <h3 class="card-title">Ciudades</h3>

                    <div class="row">
                        @foreach ($cityGroups as $citygroup)

                            <div class="col-md3 mt3">

                                @foreach ($citygroup as $item)

                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input section"
                                                                data-section-id="{{$item->id}}"
                                                                id="section_{{$item->id}}"/>
                                        <label for="section_{{$item->id}}" class="form-check-label">{{$item->name}}</label>
                                    </div>

                                @endforeach

                            </div>
                        @endforeach
                    </div>

                </div>
            </div> --}}

            {{-- Permissions --}}
            <div class="card mb3 mx5 my5">
                <div class="card-body mt-3">

                    <h3 class="card-title">Permisos</h3>

                    <div class="row">
                        @foreach ($modules as $key=>$module)


                        <div class="col-md3 mt3">

                            <h5> {{$key}} </h5>

                            @foreach ($module as $item)

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input permission"
                                                            data-permission-id="{{$item->id}}"
                                                            id="permission{{$item->id}}"/>
                                    <label for="permission_{{$item->id}}" class="form-check-label">{{$item->description}}</label>
                                </div>

                            @endforeach

                        </div>
                        @endforeach
                    </div>
            </div>
            <div class="text center">
                        <button type="submit" class="btn btn-primary" form="frmCreate" id="btnSave">Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Go back</a>
                    </div>

        </div>
    </section>


@endsection


<script type="module">

    $(document).ready(function(){

        $('#btnSave').click(function(event){

            //Sections
            // const sections=$('.section:checked');

            // let seccionIds=[];

            // sections.each(function(){

            //     const sectionId=$(this).data('section-id')
            //     seccionIds.push(sectionId);

            // });

            // $('#sections').val(JSON.stringify(sectionIds));

            //Permissions
            const permissions=$('.permission:checked');

            var permissionIds=[];

            permissions.each(function(){

                const permissionId = $(this).data('permission-id')
                permissionIds.push(permissionId);

            });
            // console.log(permissionIds);

            $('#permissions').val(JSON.stringify(permissionIds));
        });
    });



</script>
