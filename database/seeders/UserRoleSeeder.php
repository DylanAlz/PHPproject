<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Administrador
            $adminRole = new Role();
            $adminRole->role_id = 9;
            $adminRole->name = 'Administrador';
            $adminRole->description = 'Rol de administrador';
            $adminRole->save();

            // Vendedor
            $sellerRole = new Role();
            $sellerRole->role_id = 10;
            $sellerRole->name = 'Vendedor';
            $sellerRole->description = 'Rol de vendedor';
            $sellerRole->save();

            $cityPermissions = Permission::where('module', '=', 'city')
                                    ->get();

            foreach ($cityPermissions as $permission) {
                $rolePermission = new RolePermission();
                $rolePermission->role_id = $sellerRole->role_id;
                $rolePermission->permission_id = $permission->id; 
                $rolePermission->save();
            }

            // Gestor de usuario
            $userManagerRole = new Role();
            $userManagerRole->role_id = 11;
            $userManagerRole->name = 'Gestor de usuario';
            $userManagerRole->description = 'Rol de gestor de usuario';
            $userManagerRole->save();

            $userPermissions = Permission::where('module', '=', 'departament')
                                    ->get();
                                    
            foreach ($userPermissions as $permission) {
                $rolePermission = new RolePermission();
                $rolePermission->role_id = $userManagerRole->role_id;
                $rolePermission->permission_id = $permission->id; 
                $rolePermission->save();
            }

        // Users
        $user = new User();
        $user->first_name = 'Dylan';
        $user->last_name = 'Alzate';
        $user->document = '1007053815';
        $user->email = 'alzatedylan@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('12345');
        $user->role_id = $adminRole->role_id;
        $user->save();

        $user = new User();
        $user->first_name = 'Andres';
        $user->last_name = 'Angel';
        $user->document = '1007053816';
        $user->email = 'andresangel@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('12345678');
        $user->role_id = $sellerRole->role_id;
        $user->save();

        $user = new User();
        $user->first_name = 'Cristian';
        $user->last_name = 'David';
        $user->document = '1007053817';
        $user->email = 'cristiandavid@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('87654321');
        $user->role_id = $userManagerRole->role_id;
        $user->save();
    }
}