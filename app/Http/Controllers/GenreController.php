<?php

namespace App\Http\Controllers;

use App\Models\genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $recordsPerPage = $request->records_per_page ?? env('PAGINATION_DEFAULT_SIZE');
        $recordsPerPage = min($recordsPerPage, env('PAGINATION_MAX_SIZE'));

        $genres = genre::where('genre_', 'LIKE', "%{$request->filter}%")
            ->paginate($recordsPerPage);

        return view('genre.index', ['genres' => $genres, 'data' => $request]);
    }

    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'genre_id' => 'required|integer|unique:genre,genre_id',
            'genre_' => 'required|string|max:25',
            'description' => 'required|string|max:50',
            'active' => 'required|boolean',
        ])->validate();

        try {
            $genre = new genre();
            $genre->genre_id = $request->genre_id;
            $genre->genre_ = $request->genre_;
            $genre->description = $request->description;
            $genre->active = $request->active;
            $genre->save();

            Session::flash('message', ['content' => 'Genre created successfully.', 'type' => 'success']);
            return redirect()->route('genre.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $genre = genre::find($id);

        if (!$genre) {
            Session::flash('message', ['content' => "Genre with id: '$id' not found.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('genre.edit', compact('genre'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'genre_id' => 'required|integer|exists:genre,genre_id',
            'genre_' => 'required|string|max:25',
            'description' => 'required|string|max:50',
            'active' => 'required|boolean',
        ])->validate();

        try {
            $genre = genre::find($request->genre_id);
            $genre->genre_ = $request->genre_;
            $genre->description = $request->description;
            $genre->active = $request->active;
            $genre->save();

            Session::flash('message', ['content' => 'Genre updated successfully.', 'type' => 'success']);
            return redirect()->route('genre.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $genre = genre::find($id);
            if (!$genre) {
                Session::flash('message', ['content' => "Genre with id: '$id' not found.", 'type' => 'error']);
                return redirect()->back();
            }
            $genre->delete();
            Session::flash('message', ['content' => 'Genre deleted successfully.', 'type' => 'success']);
            return redirect()->route('genre.index');
        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}

