<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\{Match, User, Score};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\ScoreEvent;
use Pusher\Pusher;

class GuestController extends Controller
{
    public function live()
    {
        $matches = Match::where('status', '!=', 'finished')->with('arbitreRef')->orderBy('id', 'desc')->get();
        foreach ($matches as $m => $match) {
            $match->status == 'waiting' ? $match['badge'] = 'info' : '';
            $match->status == 'ongoing' ? $match['badge'] = 'success' : '';
            $match->status == 'pending' ? $match['badge'] = 'warning' : '';
            $match->status == 'finished' ? $match['badge'] = 'primary' : '';
            $match['badge'] ?? 'default';
        }
        return view('app.guest.live', compact('matches'));
    }

    public function all()
    {
        $matches = Match::with('arbitreRef')->orderBy('id', 'desc')->get();
        foreach ($matches as $m => $match) {
            $match->status == 'waiting' ? $match['badge'] = 'info' : '';
            $match->status == 'ongoing' ? $match['badge'] = 'success' : '';
            $match->status == 'pending' ? $match['badge'] = 'warning' : '';
            $match->status == 'finished' ? $match['badge'] = 'primary' : '';
            $match['badge'] ?? 'default';
        }
        return view('app.guest.all', compact('matches'));
    }
}
