<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index() {
        $city = city::all();

        return view('city/index', [ 'city' => $city ]);
    }

    public function create() {
        $city = city::all();

        return view('city/create');
    }

    public function store(Request $request) {
        $city = city::all();

        return view('city/create');

        Valdidator::make($request->all(), [
            'name' => 'required|max:100'
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $department = new Department();

            $department->name = $request->name;

            $department->save();

            Sesssion::flash('message', );

        } catch (\Exception $ex) {

        }
    }
}
