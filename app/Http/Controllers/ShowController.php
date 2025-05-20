<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShowController extends Controller
{
    public function index(Request $request)
    {
        $recordsPerPage = $request->records_per_page ?? env('PAGINATION_DEFAULT_SIZE');
        $recordsPerPage = min($recordsPerPage, env('PAGINATION_MAX_SIZE'));

        $shows = Show::with(['room', 'movie', 'worker'])
            ->whereHas('movie', function ($query) use ($request) {
                if (!empty($request->filter)) {
                    $query->where('title', 'LIKE', '%' . $request->filter . '%');
                }
            })
            ->paginate($recordsPerPage);

        return view('show.index', ['shows' => $shows, 'data' => $request]);
    }

    public function create()
    {
        $rooms = Room::all();
        $movies = Movie::all();
        $workers = Worker::all();

        return view('show.create', compact('rooms', 'movies', 'workers'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'show_id' => 'required|integer|unique:show,show_id',
            'room_id' => 'required|exists:room,room_id',
            'movie_id' => 'required|exists:movie,movie_id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'price' => 'required|integer|min:0',
            'worker_id' => 'nullable|exists:worker,worker_id',
            'active' => 'required|boolean',
        ])->validate();

        try {
            $show = new Show();
            $show->show_id = $request->show_id;
            $show->room_id = $request->room_id;
            $show->movie_id = $request->movie_id;
            $show->date = $request->date;
            $show->time = $request->time;
            $show->price = $request->price;
            $show->worker_id = $request->worker_id;
            $show->active = $request->active;
            $show->save();

            Session::flash('message', ['content' => 'Show created successfully.', 'type' => 'success']);
            return redirect()->action([ShowController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $show = Show::find($id);
        $rooms = Room::all();
        $movies = Movie::all();
        $workers = Worker::all();

        if (!$show) {
            Session::flash('message', ['content' => "Show with id: '$id' not found.", 'type' => 'error']);
            return redirect()->back();
        }

        return view('show.edit', compact('show', 'rooms', 'movies', 'workers'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'room_id' => 'required|exists:room,room_id',
            'movie_id' => 'required|exists:movie,movie_id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'price' => 'required|integer|min:0',
            'worker_id' => 'nullable|exists:worker,worker_id',
            'active' => 'required|boolean',
        ])->validate();

        try {
            $show = Show::find($request->show_id);

            if (!$show) {
                Session::flash('message', ['content' => "Show not found.", 'type' => 'error']);
                return redirect()->back();
            }

            $show->room_id = $request->room_id;
            $show->movie_id = $request->movie_id;
            $show->date = $request->date;
            $show->time = $request->time;
            $show->price = $request->price;
            $show->worker_id = $request->worker_id;
            $show->active = $request->active;
            $show->save();

            Session::flash('message', ['content' => 'Show updated successfully.', 'type' => 'success']);
            return redirect()->action([ShowController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try {
            $show = Show::find($id);

            if (!$show) {
                Session::flash('message', ['content' => "Show with id: '$id' not found.", 'type' => 'error']);
                return redirect()->back();
            }

            $show->delete();

            Session::flash('message', ['content' => 'Show deleted successfully.', 'type' => 'success']);
            return redirect()->action([ShowController::class, 'index']);

        } catch (\Exception $ex) {
            Log::error($ex);
            Session::flash('message', ['content' => 'There was an error.', 'type' => 'error']);
            return redirect()->back();
        }
    }
}
