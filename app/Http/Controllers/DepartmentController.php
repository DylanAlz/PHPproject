<?php

namespace App\Http\Controllers;

use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index() {
        $department = department::all();

        return view('department/index', [ 'department' => $department ]);
    }

    public function create() {
        $department = department::all();

        return view('department/create');
    }

    public function store(Request $request) {
        $department = department::all();

        return view('department/create');

        Valdidator::make($request->all(), [
            'name' => 'required|max:100'
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $city = new City();

            $city->name = $request->name;

            $city->save();

            Sesssion::flash('message', );

        } catch (\Exception $ex) {

        }
    }
}
