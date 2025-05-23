@extends('layouts.app')

@section('content')

<section id="hero" class="hero section">
    <div class="card mx-5 my-5" style="background-color: #cccccc;">
        <div class="card-header" style="background-color: #556270;">
            <h3 style="color: white;">Edit Role</h3>
        </div>

        {{-- Role --}}
        <div class="card mx5 my5 mb3">
            <div class="card-body mt-3">

                <form action="{{route('roles.update')}}"  method="POST" id="frmCreate">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="role_id" value="{{$roles->id}}"/>
                    <input type="hidden" name="permissions" id="permissions"/>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name" placeholder="Nombre..." value="{{$roles->name}}"/>
                            <label>Role</label>
                        </div>
                    </div>

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
                                            <input type="checkbox"
                                                class="form-check-input permission"
                                                data-permission-id="{{$item->id}}"
                                                id="permission{{$item->id}}"
                                                {{$item->selected ? 'checked': '' }} />
                                            <label for="permission_{{$item->id}}" class="form-check-label">{{$item->description}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="text center">
                        <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Go back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

@endsection

<script type="module">
    $(document).ready(function(){
        $('#btnSave').click(function(event){
            event.preventDefault(); // Evita el submit por defecto

            //Permissions
            const permissions = $('.permission:checked');
            var permissionIds = [];
            permissions.each(function(){
                const permissionId = $(this).data('permission-id')
                permissionIds.push(permissionId);
            });
            $('#permissions').val(JSON.stringify(permissionIds));

            // Envía el formulario después de actualizar el campo
            $('#frmCreate').submit();
        });
    });
</script>
