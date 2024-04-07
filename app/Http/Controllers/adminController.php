<?php

namespace App\Http\Controllers;

use App\Models\Models\Candidate;
use App\Models\Models\Election;
use App\Models\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
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
        $data['elections'] = Election::all();
        $data['candidates'] = Candidate::all();
        $data['votes'] = Vote::all();

        $data['monthlyElections'] = $this->calculateMonthlyElections();
        $data['maleCount'] = $data['candidates']->where('gender', 'laki_laki')->count();
        $data['femaleCount'] = $data['candidates']->where('gender', 'perempuan')->count();
        $data['monthlyVotes'] = $this->calculateMonthlyVotes();

        // Menginisialisasi array bulan dengan jumlah hari sesuai bulan saat ini
        $data['daysArray'] = range(1, Carbon::now()->daysInMonth);

        return view('admin.dashboard', $data);
    }
    private function calculateMonthlyElections()
    {
        $monthlyElections = Election::selectRaw('MONTH(start_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        $totals = [];

        // Inisialisasi nilai total pemilihan untuk setiap bulan
        for ($i = 1; $i <= 12; $i++) {
            $totals[$i] = 0;
        }

        // Mengisi nilai total pemilihan untuk setiap bulan dari hasil query
        foreach ($monthlyElections as $election) {
            $month = $election->month;
            $totals[$month] = $election->total;
        }

        return $totals;
    }
    private function calculateMonthlyVotes()
    {
        return Vote::selectRaw('DAY(created_at) as day, COUNT(*) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('day')
            ->get()
            ->pluck('total', 'day')
            ->toArray();
    }
    public function election()
    {
        $data['elections'] = Election::all();
        return view('admin.election', $data);
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

        $election = Election::create($validateData);
        return redirect()->route('adminElection')->with('success', 'Data Election berhasil dibuat');
    }
    public function electionEdit($id)
    {
        $election = Election::findOrFail($id);
        return view('admin.election-edit', compact('election'));
    }
    public function electionUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:aktif,selesai,ditutup',
        ]);
        
        $election = Election::findOrFail($id);
        $election->name = $request->name;
        $election->description = $request->description;
        $election->start_date = $request->start_date;
        $election->end_date = $request->end_date;
        $election->status = $request->status;
        $election->save();

        return redirect()->route('adminElection')->with('success', 'Data Election berhasil diperbarui');
    }

    public function electionDelete($id)
    {
        $election = Election::findOrFail($id);
        $election->delete();
    
        return redirect()->route('adminElection')->with('success', 'Data Election berhasil dihapus');
    }
    

    public function candidate()
    {
        $data['candidates'] = Candidate::select('candidates.*', 'elections.name as nama_election')
            ->leftJoin('elections', 'candidates.election_id', '=', 'elections.id')
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
        $namaFile = time() . "_" . $validateData['name'] . "." . $extFile;
        $resizedImage = Image::make($request->photo)->resize(600, 800);
        $resizedImage->save(public_path('candidate/' . $namaFile));
        $path = "/candidate/".$namaFile;
        $validateData['photo'] = $path;

        $candidate = Candidate::create($validateData);
        return redirect()->route('adminCandidate')->with('success', 'Data Candidate berhasil dibuat');
    }

    public function candidateEdit($id)
    {
        $candidate = Candidate::findOrFail($id);
        $election = Election::where('status','aktif')->get();
        return view('admin.candidate-edit', compact('candidate','election'));
    }
    

    public function candidateUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'election_id' => 'required|integer',
            'name' => 'required|string',
            'gender' => 'required|in:laki_laki,perempuan',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2000',
            'visi_misi' => 'required|string',
        ]);
    
        $candidate = Candidate::findOrFail($id);
        $candidate->name = $validateData['name'];
        $candidate->gender = $validateData['gender'];
        $candidate->visi_misi = $validateData['visi_misi'];
        $candidate->election_id = $validateData['election_id'];
    
        if ($request->hasFile('photo')) {
            if ($candidate->photo) {
                File::delete(public_path($candidate->photo));
            }

            // Jika ada file foto yang diunggah, simpan dan update path fotonya
            $extFile = $request->photo->getClientOriginalExtension();
            $namaFile = time() . "_" . $validateData['name'] . "." . $extFile;
            $resizedImage = Image::make($request->photo)->resize(600, 800);
            $resizedImage->save(public_path('candidate/' . $namaFile));
            $path = "/candidate/" . $namaFile;
            $candidate->photo = $path;
        }
    
        $candidate->save();
    
        return redirect()->route('adminCandidate')->with('success', 'Candidate updated successfully');
    }

    public function candidateDelete($id)
    {
        $candidate = Candidate::findOrFail($id);
        if ($candidate->photo) {
            File::delete(public_path($candidate->photo));
        }
        $candidate->delete();
    
        return redirect()->route('adminCandidate')->with('success', 'Data Candidate berhasil dihapus');
    }
    public function votes()
    {
        $data['election'] = Election::all();
        $data['candidates'] = null;
        
        return view('admin.votes',$data);
    }
    public function votesHandler(Request $request)
    {
        $data['election'] = Election::all();
        $request->validate([
            'election_id' => 'required|exists:elections,id'
        ]);

        $electionId = $request->input('election_id');

        $data['candidates'] = Candidate::with('election')
            ->where('election_id', $electionId)
            ->orderByDesc('votes_count')
            ->get();

        // Hitung total suara untuk pemilihan ini
        $data['totalVotes'] = $data['candidates']->sum('votes_count');

        // Hitung persentase suara untuk setiap kandidat
        foreach ($data['candidates'] as $candidate) {
            $candidate->vote_percentage = $data['totalVotes'] > 0 ? number_format(($candidate->votes_count / $data['totalVotes']) * 100, 2) : 0;
        }

        return view('admin.votes',$data);
    }
    public function votesSinkron()
    {
        // Ambil semua kandidat
        $candidates = Candidate::all();

        // Loop melalui setiap kandidat
        foreach ($candidates as $candidate) {
            // Hitung total voting untuk kandidat ini
            $totalVotes = Vote::where('candidate_id', $candidate->id)->count();

            // Update kolom votes_count untuk kandidat ini
            $candidate->update([
                'votes_count' => $totalVotes
            ]);
        }
        return "Data voting sudah sinkron";
        }
}
