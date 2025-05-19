<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $recordsPerPage = $request->get('records_per_page', env('PAGINATION_DEFAULT_SIZE', 10));
        $recordsPerPage = min($recordsPerPage, env('PAGINATION_MAX_SIZE', 50));

        $roles = Role::where('name', 'like', "%{$request->filter}%")
                     ->paginate($recordsPerPage);

        return view('role.index', [
            'roles' => $roles,
            'data' => $request
        ]);
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'role_id' => 'required|integer|unique:role,role_id',
            'name' => 'required|max:25|unique:role,name',
            'description' => 'nullable|max:25',
        ])->validate();

        try {
            $role = new Role();
            $role->role_id = $request->role_id;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            Session::flash('message', ['content' => 'Role created successfully.', 'type' => 'success']);
            return redirect()->route('role.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back()->withInput();
        }
    }

    public function edit($role_id)
    {
        $role = Role::find($role_id);

        if (!$role) {
            Session::flash('message', ['content' => "Role with ID $role_id not found.", 'type' => 'error']);
            return redirect()->route('role.index');
        }

        return view('role.edit', ['role' => $role]);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'role_id' => 'required|exists:role,role_id',
            'name' => 'required|max:25|unique:role,name,' . $request->role_id . ',role_id',
            'description' => 'nullable|max:25',
        ])->validate();

        try {
            $role = Role::find($request->role_id);
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();

            Session::flash('message', ['content' => 'Role updated successfully.', 'type' => 'success']);
            return redirect()->route('role.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back()->withInput();
        }
    }

    public function delete($role_id)
    {
        try {
            $role = Role::find($role_id);

            if (!$role) {
                Session::flash('message', ['content' => "Role with ID $role_id not found.", 'type' => 'error']);
                return redirect()->route('role.index');
            }

            $role->delete();
            Session::flash('message', ['content' => 'Role deleted successfully.', 'type' => 'success']);
            return redirect()->route('role.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
    public function permissions()
{
    return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
}

}
