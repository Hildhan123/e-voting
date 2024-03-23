<?php

namespace App\Http\Controllers;

use App\Models\Models\Candidate;
use App\Models\Models\Election;
use App\Models\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Image;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('login','loginHandler');
    }
    public function login()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('adminDashboard');
        } else {
            return view('admin.login');
        }
    }
    public function loginHandler(Request $request)
    {
        $credentials = $request->only('name','password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('adminDashboard');
        }
        return redirect()->route('adminLogin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function election()
    {
        return view('admin.election');
    }
    public function electionCreate()
    {
        return view('admin.election-create');
    }
    public function electionStore(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:aktif,selesai,ditutup',
        ]);

        $validateData['start_date'] = $validateData['start_date']->format('Y-m-d');
        $validateData['end_date'] = $validateData['end_date']->format('Y-m-d');

        $election = Election::create($validateData);
        return $election;
    }
    public function electionEdit($id)
    {
        return view('admin.election-edit');
    }
    public function electionUpdate(Request $request)
    {

    }
    public function candidate()
    {
        $data['candidates'] = Candidate::select('candidates.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('votes')
                    ->whereColumn('votes.candidate_id', 'candidates.id');
            }, 'vote_count')
            ->get();

        return view('admin.candidate', $data);
    }
    public function candidateCreate()
    {
        $data['election'] = Election::where('status','aktif')->get();
        return view('admin.candidate-create',$data);
    }
    public function candidateStore(Request $request)
    {
        $validateData = $request->validate([
            'election_id' => 'required|integer',
            'name' => 'required|string',
            'gender' => 'required|in:laki_laki,perempuan',
            'photo' => 'required|file|mimes:png,jpg,jpeg|max:2000',
            'visi_misi' => 'required|string',
        ]);
        
        $extFile = $request->photo->getClientOriginalExtension();
        $namaFile = time()."{$validateData['name']}".".".$extFile;
        $resizedImage = Image::make($request->photo)->resize(600, 800);
        $resizedImage->save(public_path('candidate/' . $namaFile));
        $path = "/candidate/".$namaFile;
        $validateData['photo'] = $path;

        $candidate = Candidate::create($validateData);
        return $candidate;
    }
}
