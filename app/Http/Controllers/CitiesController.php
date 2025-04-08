<?php

namespace App\Http\Controllers;

use App\Models\city;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CitiesController extends Controller
{
    public function index() {
        $city = city::all();

        return view('city/index', [ 'city' => $city ]);
    }

    public function create() {

        return view('city/create');
    }

    public function store(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required|max:100'
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $city = new City();

            $city->name = $request->name;

            $city->save();

            Session::flash('message', ['content' => 'Ciudad creada con éxito.', 'type' => 'success']);
            return redirect()->action([CitiesController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'Ha ocurrido un error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id) {

        $city = City::find($id);

        if (empty($city)) {

            Session::flash('message', ['content ' => "The city with id: '$id' doesn't exist.", 'type' => 'error']);
            return redirect()->back();

        }
        return view('city/edit', ['city' => $city]);
    }

    public function update(Request $request) {

        Validator::make($request->all(), [
            'name' => 'required|max:100',
            'city_id' => 'required|exists:cities,id',
        ], [
            'name.required' => 'The name is required.',
            'name.max' => 'The name cannot surpass :max characters.'
        ])->validate();

        try {

            $city = City::find($request->city_id);

            $city->name = $request->name;

            $city->save();

            Session::flash('message', ['content' => 'City updated succesfully.', 'type' => 'success']);
            return redirect()->action([CitiesController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id) {

        try {

            $city = City::find($id);

            if (empty($city)) {

                Session::flash('message', ['content ' => "The city with id: '$id' doesn't exist.", 'type' => 'error']);
                return redirect()->back();

            }

            $city->delete();

            Session::flash('message', ['content' => 'City deleted succesfully.', 'type' => 'success']);
            return redirect()->action([CitiesController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
