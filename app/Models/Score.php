<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'match_id', 'score'
    ];

    public function matchRef(){
        return $this->belongsTo(Match::class,'match_id','id');
    }

    public function scopeMakeScore(){
        $arrayScore = [];
        for ($a = 0; $a < 13; $a++) { 
            array_push($arrayScore, [0,0]);
        }
        $scoreData = [
            'n' => [],
            'total' => [],
            'log' => $arrayScore,
        ];
        return $scoreData;
    }
}
