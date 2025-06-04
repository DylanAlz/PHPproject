<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'show';

    // Relación con Movie
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'movie_id');
    }

    // Relación con Room
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    // Relación con Worker
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id', 'worker_id');
    }
}
