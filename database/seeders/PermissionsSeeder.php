<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            // City
            ['name' => 'showCity', 'description' => 'Ver ciudades', 'module' => 'city'],
            ['name' => 'createCity', 'description' => 'Crear ciudad', 'module' => 'city'],
            ['name' => 'updateCity', 'description' => 'Actualizar ciudad', 'module' => 'city'],
            ['name' => 'deleteCity', 'description' => 'Borrar ciudad', 'module' => 'city'],

            // Department        
            ['name' => 'showDepartament', 'description' => 'Ver departamentos', 'module' => 'departament'],
            ['name' => 'createDepartament', 'description' => 'Crear Departamento', 'module' => 'departament'],
            ['name' => 'updateDepartament', 'description' => 'Actualizar Departamento', 'module' => 'departament'],
            ['name' => 'deleteDepartament', 'description' => 'Borrar Departamento', 'module' => 'departament'],

        ];
        foreach ($permissions as $permission) {
            $tmpPermission = Permission::where('name', '=', $permission['name'])
                ->where('module', '=', $permission['module'])
                ->first();

            if (empty($tmpPermission)) {
                $newPermission = new Permission();
                $newPermission->name = $permission['name'];
                $newPermission->description = $permission['description'];
                $newPermission->module = $permission['module'];
                $newPermission->save();
            }
        }
    }
}
