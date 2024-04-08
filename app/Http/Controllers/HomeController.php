<?php

namespace App\Http\Controllers;

use App\Models\Models\Candidate;
use App\Models\Models\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Models\Election;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
    public function profil()
    {
        return view('profil');
    }
    public function profilHandler(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'string',
            'email' => [
                'email',
                Rule::unique('users')->ignore(Auth::user()->id), // Menggunakan aturan unique dengan pengecualian untuk ID pengguna saat ini
            ],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->save();
        return $user;
    }
    public function changePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Memeriksa apakah password saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Password saat ini salah.'],
            ]);
        }

        // Memperbarui password user
        $user->password = Hash::make($request->password);
        $user->save();

        return "Password berhasil diubah";
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

        if($selectedCandidate) {
            if ($selectedCandidate->gender != Auth::user()->gender && Auth::user()->role == 'siswa') {
                return 'Anda hanya bisa memilih kandidat dengan gender yang sesuai dengan Anda.';
            }
            $election = Election::where('status','aktif')->first();
    
            $createVote =  Vote::create([
                'user_id' => Auth::user()->id,
                'election_id' => $election->id,
                'candidate_id' => $request->vote,
            ]);
            $selectedCandidate->votes_count += 1;
            $selectedCandidate->save();
        
            return redirect()->route('vote')->with('success', 'Suara Anda telah berhasil disimpan!');
        } else {
            abort(404);
        }
    }
}
