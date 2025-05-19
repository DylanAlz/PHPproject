<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RolePermissionController extends Controller
{
    // Ver permisos asignados a un rol
    public function index($role_id = null)
{
    if ($role_id) {
        $role = Role::find($role_id);

        if (!$role) {
            Session::flash('message', ['content' => "Role not found.", 'type' => 'error']);
            return redirect()->route('role.index');
        }

        // Relación definida en el modelo Role: permissions()
        $permissions = $role->permissions;
        return view('rolepermissions.index', compact('role', 'permissions'));
    }

    // Si no hay role_id, traer todas las relaciones role-permission
    $role_permissions = RolePermission::with(['role', 'permission'])->paginate(10);

    return view('rolepermissions.index', compact('role_permissions'));
}

    // Mostrar formulario para asignar permisos
    public function edit($role_id)
    {
        $role = Role::find($role_id);
        if (!$role) {
            Session::flash('message', ['content' => "Role not found.", 'type' => 'error']);
            return redirect()->route('role.index');
        }

        $allPermissions = Permission::all();
        $assignedPermissions = $role->permissions->pluck('id')->toArray();

        return view('rolepermissions.edit', compact('role', 'allPermissions', 'assignedPermissions'));
    }

    // Guardar asignaciones de permisos
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:role,role_id',
            'permissions' => 'array'
        ]);

        try {
            // Elimina permisos anteriores
            RolePermission::where('role_id', $request->role_id)->delete();

            // Inserta nuevos
            if ($request->has('permissions')) {
                foreach ($request->permissions as $permission_id) {
                    RolePermission::create([
                        'role_id' => $request->role_id,
                        'permission_id' => $permission_id,
                    ]);
                }
            }

            Session::flash('message', ['content' => 'Permissions updated successfully.', 'type' => 'success']);
            return redirect()->route('rolepermissions.index', $request->role_id);

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message', ['content' => 'An error occurred.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    // Eliminar una asignación específica
    public function delete($id)
    {
        try {
            $assignment = RolePermission::findOrFail($id);
            $roleId = $assignment->role_id;
            $assignment->delete();

            Session::flash('message', ['content' => 'Permission removed from role.', 'type' => 'success']);
            return redirect()->route('rolepermissions.index', $roleId);
        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message', ['content' => 'An error occurred.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
