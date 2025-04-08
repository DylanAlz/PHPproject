<?php

namespace App\Http\Controllers;

use App\Models\department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index() {
        $department = department::all();

        return view('department/index', [ 'department' => $department ]);
    }

    public function create() {

        return view('department/create');
    }

    public function store(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required|max:100'
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $department = new Department();

            $department->name = $request->name;

            $department->save();

            Session::flash('message', ['content' => 'Department created succesfully.', 'type' => 'success']);
            return redirect()->action([DepartmentController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {

        $department = Department::find($id);

        if (empty($department)) {

            Session::flash('message', ['content ' => "The department with id: '$id' doesn't exist.", 'type' => 'error']);
            return redirect()->back();

        }
        return view('department/edit', ['department' => $department]);
    }

    public function update(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required|max:100',
            'department_id' => 'required|exists:departments,id',
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $department = Department::find($request->department_id);

            $department->name = $request->name;

            $department->save();

            Session::flash('message', ['content' => 'Department updated succesfully.', 'type' => 'success']);
            return redirect()->action([DepartmentController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {

            $department = Department::find($id);

            if (empty($department)) {

                Session::flash('message', ['content ' => "The department with id: '$id' doesn't exist.", 'type' => 'error']);
                return redirect()->back();

            }

            $department->delete();

            Session::flash('message', ['content' => 'Department deleted succesfully.', 'type' => 'success']);
            return redirect()->action([DepartmentController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
