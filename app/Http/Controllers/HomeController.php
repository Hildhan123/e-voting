<?php

namespace App\Http\Controllers;

use App\Models\Models\Candidate;
use App\Models\Models\Vote;
use Illuminate\Http\Request;
use App\Models\Models\Election;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function vote()
    {
        $data['election'] = Election::where('status','aktif')->first();
        $data['candidates'] = Candidate::where('election_id',$data['election']->id)->get();
        $data['vote'] = Vote::where('user_id',Auth::user()->id)->first();

        return view('vote',$data);
    }
    public function voteHandler(Request $request)
    {
        $request->validate([
            'vote' => 'required|integer',
        ]);

        $vote = Vote::where('user_id',Auth::user()->id)->first();

        if($vote) {
            return 'Anda sudah memilih';
        }

        $selectedCandidate = Candidate::find($request->vote);

        if ($selectedCandidate->gender != Auth::user()->gender) {
            return 'Anda hanya bisa memilih kandidat dengan gender yang sesuai dengan Anda.';
        }

        $election = Election::where('status','aktif')->first();

        $createVote =  Vote::create([
            'user_id' => Auth::user()->id,
            'election_id' => $election->id,
            'candidate_id' => $request->vote,
        ]);
    
        return $createVote;
    }
}
