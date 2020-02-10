<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'player_one', 'player_two', 'duration', 'field', 'arbitre', 'status', 'timer', 'startTime', 'endTime'
    ];

    public function arbitreRef(){
        return $this->belongsTo(User::class,'arbitre','id');
    }
}
