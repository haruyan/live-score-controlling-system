<?php

namespace App\Http\Controllers;

use App\Models\{Match, User, Score};
use App\Events\ScoreEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class ScoreController extends Controller
{
    public function viewControl($id)
    {
        $numbers = ['one', 'two', '3', '4', '5', '6'];
        $match = Match::with('arbitreRef')->findOrFail($id);

        $score = Score::where('match_id',$id)->first();
        if (!$score) {
            $scoreInit = Score::MakeScore();
            $score = json_encode($scoreInit);
        } else {
            $score = $score->score; //has been encoded from db
        }

        $button = [ 'point' => 'disabled', 'undo' => 'disabled', 'pause' => 'disabled' ];
        $in_array = in_array($match->status, ['pending', 'finished']);
        $button['finish'] = ($in_array == false ?  '' : 'disabled');
        $button['play'] = ($match->status == 'finished' ? 'disabled' :  '');
        return view('app.match-live.control', compact('id', 'numbers', 'button', 'match', 'score'));
    }
    
    public function viewLive($id)
    {
        $score = Score::where('match_id',$id)->first();
        if (!$score) {
            $scoreInit = Score::MakeScore();
            $score = json_encode($scoreInit);
        } else {
            $score = $score->score;
        }
        $match = Match::where('id', $id)->with('arbitreRef')->first();
        return view('app.match-live.score', compact('id', 'match', 'score'));
    }

    public function status(Request $request, Score $model)
    {
        $match = Match::where('id', $request->id)->first();
        $match->status == 'waiting' ? ($match->startTime = $request->currentTime) : '';
        $request->status == 'finished' ? ($match->endTime = $request->currentTime) : '';
        $match->status = $request->status;
        $match->timer = $request->timer;
        $match->save();
        
        $score = Score::where('match_id', $request->id)->with('matchRef')->first();
        if( $request->score != null){
          $score->score = json_encode($request->score);
          $score->save();
        }
       
        if($score == null ){
            $scoreInit = Score::MakeScore();
            $model->create([
                'match_id' => $request->id,
                'score' => json_encode($scoreInit),
            ]);
            $score = $model;
          
          $send = [
            'match' => $model,
            ];
        }
        else{
            $send = [
            'match' => $score,
            ];
        }
        
        $send['match']->score = json_decode($send['match']->score);
        event(new ScoreEvent($request->id, $send));

        $data['match'] = $match;
        $data['score'] = $score;

        return response()->json($send);
    }

    public function set(Request $request)
    {
        $score = Score::where('match_id', $request->id)->with('matchRef')->first();
        $score->score = $request->data;
        $send = [
            'match' => $score,
        ];
        event(new ScoreEvent($request->id, $send));
        $score->score = json_encode($request->data);
        $score->save();
        
        return response($score);
    }
}
