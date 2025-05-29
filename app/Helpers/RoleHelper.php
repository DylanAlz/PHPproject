<?php
namespace App\Helpers;

#use Illuminate\Container\Attributes\Auth;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleHelper{

    public static function currentUserAdmin(){

        try{

            $role=Auth::user()->role->name;

            return $role=='Administrador';

        }
        catch(\Exception $ex){

            dd($ex);

        }


    }


    public static function isAuthorized($permission){

        try{

            if (!Auth::check()){

                return false;

            }

            if(RoleHelper::currentUserAdmin()){

                return true;

            }
            $userId=Auth::user()->id;
            $obj=explode('.',$permission);
            $module=$obj[0];
            $permissionName=$obj[1];

            $permissionId=Permission::select('permissions.id')
                                    ->join('role_permissions','permissions.id','role_permissions.permission_id')
                                    ->join('roles','role_permissions.role_id','roles.id')
                                    ->join('users','roles.id','users.role_id')
                                    ->where('permissions.module','=',$module)
                                    ->where('permissions.name','=',$permissionName)
                                    ->where('users.id','=',$userId)
                                    ->first();
            return $permissionId != null;
        }
        catch(\Exception $ex){

            dd($ex);

        }

    }

}
