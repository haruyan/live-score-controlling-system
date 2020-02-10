<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\{Match, User, Score};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\ScoreEvent;
use Pusher\Pusher;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arbitres = User::where('role', 'arbitre')->get();
        if (Auth::user()->role == 'admin') {
            $matches = Match::with('arbitreRef')->get();
        } else {
            $matches = Match::where('arbitre', Auth::user()->id)->with('arbitreRef')->get();
        }
        // return response()->json($matches);
        foreach ($matches as $m => $match) {
            $match->status == 'waiting' ? $match['badge'] = 'info' : '';
            $match->status == 'ongoing' ? $match['badge'] = 'success' : '';
            $match->status == 'pending' ? $match['badge'] = 'warning' : '';
            $match->status == 'finished' ? $match['badge'] = 'primary' : '';
            $match['badge'] ?? 'default';
        }
        return view('app.match.index', compact('matches', 'arbitres'));
    }

    public function liveIndex()
    {
        if (Auth::user()->role == 'admin') {
            $matches = Match::where('status', '!=', 'finished')->with('arbitreRef')->get();
        } else {
            $matches = Match::where([
                ['status', '!=', 'finished'],
                ['arbitre', Auth::user()->id],
                ])->with('arbitreRef')->get();
        }
        foreach ($matches as $m => $match) {
            $match->status == 'waiting' ? $match['badge'] = 'info' : '';
            $match->status == 'ongoing' ? $match['badge'] = 'success' : '';
            $match->status == 'pending' ? $match['badge'] = 'warning' : '';
            $match->status == 'finished' ? $match['badge'] = 'primary' : '';
            $match['badge'] ?? 'default';
        }
        return view('app.match-live.index', compact('matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Match $match)
    {
        $validator = Validator::make($request->all(),[
            'player_one' => 'required',
            'player_two' => 'required',
            'field' => 'required',
            'arbitre' => 'required|exists:users,id',
            'date' => 'required|date',
            'duration' => 'required',
        ]);
      
        if ($validator->fails()) {
            $error['status'] = 'error';
            $error['message'] = $validator->errors();
            return response()->json($error, 400);
        }

        $hours = floor($request->duration / 60);
        $minutes = $request->duration % 60;


        $match->create(
            $request->merge([
                'duration' => $hours.':'.$minutes.":00",
                'status' => 'waiting'
            ])
            ->all()
        );

        return response()->json($match);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        return response()->json($match);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        $validator = Validator::make($request->all(),[
            'player_one' => 'required',
            'player_two' => 'required',
            'field' => 'required',
            'arbitre' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);
      
        if ($validator->fails()) {
            $error['status'] = 'error';
            $error['message'] = $validator->errors();
            return response()->json($error, 400);
        }

        $match = $match;
        
        $match->update(
            $request->merge([
                'time' => $request->date . ' ' . $request->time,
            ])
            ->all()
        );

        return response()->json($match);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        $match->delete();

        return redirect()->route('match.index');
    }

    public function scoreplayer(Request $request)
    {
        $data = Score::where('match_id', $request->match_id)->first();
        if ($request->score == 1) {
            if ($data == NULL) {
                $score2 = NULL;
                $save = new Score();
                $save->match_id = $request->match_id;
                $save->score1 = 1;
                $save->save();
                event(new ScoreEvent($update->score1, $score2));
            }else{
                $update = Score::where('match_id', $request->match_id)->first();
                $update->score1 = $update->score1 + 1;
                $update->save();
                event(new ScoreEvent($update->score1, $update->score2));
            }
        }elseif($request->score == 2){
            if ($data == NULL) {
                $score1 = NULL;
                $save = new Score();
                $save->match_id = $request->match_id;
                $save->score2 = 1;
                $save->save();
                event(new ScoreEvent($score1, $update->$score2));
            }else{
                $update = Score::where('match_id', $request->match_id)->first();
                $update->score2 = $update->score2 + 1;
                $update->save();
                event(new ScoreEvent($update->score1, $update->score2));
            }
        }

        return redirect(route('match.control', $request->match_id));   
    }

}
