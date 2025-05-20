<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RoleSection;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use function Pest\Laravel\json;

class RolesController extends Controller
{
    public function index(Request $request) {

        $filter=$request;

        if (!empty($request->records_per_page)) {

            $request->records_per_page = $request->records_per_page <= env('PAGINATION_MAX_SIZE')
                                                                    ? $request->records_per_page
                                                                    : env('PAGINATION_MAX_SIZE');
        } else {

            $request->records_per_page = env('PAGINATION_DEFAULT_SIZE');

        }


        $roles = Role::where('name', 'LIKE', "%$request->filter%")
            ->paginate($request->records_per_page);

        return view('roles.index', [ 'roles' => $roles,
                                     'data' => $request ]);
    }

    public function create(){

        $modules = Permission::all()
                            ->groupBy('module');

        $cityGroups = city::all()
                            ->chunk(5);

        return view('roles.create',[
            'modules'=>$modules,
            'cityGroups'=>$cityGroups
        ]);
    }

    public function edit($id){

        $roles=Role::find($id);

        // dd($id);
        if(empty($roles)){

            Session::flash('message',['content'=>"El rol con ID '$id' no existe.",'type'=>'error']);
            return redirect()->back();
        }

        $permissions=Permission::all();

        $permissions=$permissions->map(function($item) use($id){

            $item->selected=false;

            $rolePermission=RolePermission::where('permission_id','=',$item->id)
                                            ->where('role_id','=', $id)
                                            ->first();

            if (!empty($rolePermission)){

                $item->selected=true;
            }return $item;

        });


        // $city=city::all();

        // $city=$city->map(function($item) use($id){

        //     $item->selected=false;

        //     $roleCity=RoleSection::where('city_id','=',$item->id)
        //                                     ->where('role_id','=', $id)
        //                                     ->first();

        //     if (!empty($roleCity)){

        //         $item->selected=true;
        //     }

        // });


        $modules = $permissions->groupBy('module');

        // $cityGroups = $city->chunk(5);

        return view('roles/edit',[
            'roles'=>$roles,
            'modules'=>$modules
        ]);
    }

    public function store(Request $request){

        Validator::make($request->all() ,
        [

            'name'=>'required|max:100',
            'permissions'=>'required|json',
            // 'city'=>'required|json',

        ] ,
        [
            'name.required'=>'El nombre es requerido',
            'name.max'=>'El nombre no puede ser mayor a :max carácteres',
            'permissions.required'=>'debe seleccionar al menos un permiso1',
            'permissions.json'=>'debe seleccionar al menos una ciudad',
            // 'section.json'=>'el campo ciudad tiene el formato incorrecto',
        ])->validate();

        try{

            DB::transaction(function() use($request){

                //Role
                $role=new Role();
                $role->name=$request->name;
                $role->save();

                //Permiso
                $permissions=json_decode($request->permissions);

                foreach($permissions as $permission){

                    $rolePermission=new RolePermission();
                    $rolePermission->role_id=$role->id;
                    $rolePermission->permission_id=$permission;
                    $rolePermission->save();

                }

                // $sections=json_decode($request->section);

                // foreach($sections as $section){

                //     $roleSection=new RoleSection();
                //     $roleSection->role_id=$role->id;
                //     $roleSection->section_id=$section;
                //     $roleSection->save();

                // }

            });

            Session::flash('message',['content'=>"Rol creado con exito.",'type'=>'success']);
            return redirect()->action([RolesController::class, 'index']);

        }catch(Exception $ex){


            dd($ex);
            Log::error($ex);
            Session::flash('message',['content'=>"Ha ocurrido un error.",'type'=>'error']);
            return redirect()->back();

        }

    }

    public function update(Request $request){

        Validator::make($request->all() ,
        [
            'role_id'=>'required|exists:roles,id',
            'name'=>'required|max:64',
            'permissions'=>'required|json',
            // 'city'=>'required|json',

        ] ,
        [
            'role_id.required'=>'El id del rol es requerido',
            'role_id.exist'=>'El id dado no existe',
            'name.required'=>'El nombre es requerido',
            'name.max'=>'El nombre no puede ser mayor a :max carácteres',
            'permissions.required'=>'debe seleccionar al menos un permiso',
            'permissions.json'=>'debe seleccionar al menos una ciudad o departamento',
            // 'section.json'=>'el campo ciudad tiene el formato incorrecto',
        ])->validate();

        try{

            DB::transaction(function() use($request){

                //Role
                $role=Role::find($request->role_id);
                $role->name=$request->name;
                $role->save();

                //Permisos

                // Elminación permisos antiguos
                RolePermission::where('role_id','=',$role->id)
                                ->delete();


                $permissions=json_decode($request->permissions);

                foreach($permissions as $permission){

                    $rolePermission=new RolePermission();
                    $rolePermission->role_id=$role->id;
                    $rolePermission->permission_id=$permission;
                    $rolePermission->save();

                }


                //secciones
                // Elminación secciones antiguas antiguo

                // RoleSection::where('role_id','=',$role->id)
                //             ->delete();


                // $sections=json_decode($request->section);

                // foreach($sections as $section){

                //     $roleSection=new RoleSection();
                //     $roleSection->role_id=$role->id;
                //     $roleSection->section_id=$section;
                //     $roleSection->save();

                // }

            });

            Session::flash('message',['content'=>"Rol actualizado con exito.",'type'=>'success']);
            return redirect()->action([RolesController::class, 'index']);

        }catch(Exception $ex){

            Log::error($ex);
            Session::flash('message',['content'=>"Ha ocurrido un error.",'type'=>'error']);
            return redirect()->back();

        }

    }

    public function delete($id){

        try{

            $role=Role::find($id);

            if(empty($role)){

                Session::flash('message', ['contents'=>"El rol con id '$id' no existe.", 'type'=>'error']);
                return redirect()->back();

            }

            $role->delete();

            Session::flash('message', ['contents'=>"Rol eliminado con exito.", 'type'=>'success']);
            return redirect()->action([RolesController::class, 'index']);

        }catch(Exception $ex){

            dd($ex);
            Log::error($ex);
            Session::flash('message', ['contents'=>"Ha habido un error.", 'type'=>'error']);
            return redirect()->back();

        }

    }
}
