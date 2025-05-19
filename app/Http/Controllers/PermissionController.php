<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $recordsPerPage = $request->get('records_per_page', env('PAGINATION_DEFAULT_SIZE', 10));
        $recordsPerPage = min($recordsPerPage, env('PAGINATION_MAX_SIZE', 50));

        $permissions = Permission::where('name', 'like', "%{$request->filter}%")
                                  ->paginate($recordsPerPage);

        return view('permission.index', [
            'permissions' => $permissions,
            'data' => $request
        ]);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:64|unique:permissions,name',
            'description' => 'nullable|max:256',
            'module' => 'required|max:64',
        ])->validate();

        try {
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->description = $request->description;
            $permission->module = $request->module;
            $permission->save();

            Session::flash('message', ['content' => 'Permission created successfully.', 'type' => 'success']);
            return redirect()->route('permission.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            Session::flash('message', ['content' => "Permission with ID $id not found.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:permissions,id',
            'name' => 'required|max:64|unique:permissions,name,' . $request->id,
            'description' => 'nullable|max:256',
            'module' => 'required|max:64',
        ])->validate();

        try {
            $permission = Permission::find($request->id);
            $permission->name = $request->name;
            $permission->description = $request->description;
            $permission->module = $request->module;
            $permission->save();

            Session::flash('message', ['content' => 'Permission updated successfully.', 'type' => 'success']);
            return redirect()->route('permission.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $permission = Permission::find($id);

            if (!$permission) {
                Session::flash('message', ['content' => "Permission with ID $id not found.", 'type' => 'error']);
                return redirect()->back();
            }

            $permission->delete();
            Session::flash('message', ['content' => 'Permission deleted successfully.', 'type' => 'success']);
            return redirect()->route('permission.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
}

}
