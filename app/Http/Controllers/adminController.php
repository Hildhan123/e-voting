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

    // public function election()
    // {
    //     return view('admin.election');
    // }

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

        // $validateData['start_date'] = $validateData['start_date']->format('Y-m-d');
        // $validateData['end_date'] = $validateData['end_date']->format('Y-m-d');

        $election = Election::create($validateData);
        return redirect()->route('adminElection');
    }
    public function electionEdit($id)
    {
        $election = Election::findOrFail($id);
        return view('admin.election-edit', compact('election'));
    }
    public function electionUpdate(Request $request, $id)
    {
        $election = Election::findOrFail($id);
        $election->name = $request->name;
        $election->description = $request->description;
        $election->start_date = $request->start_date;
        $election->end_date = $request->end_date;
        $election->status = $request->status;
        $election->save();

        // Setelah berhasil menyimpan perubahan, arahkan pengguna kembali ke halaman daftar Election
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
        return redirect()->route('adminCandidate');
        // return $candidate;
    }

    public function candidateEdit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidate-edit', compact('candidate'));
    }
    

    public function candidateUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|in:laki_laki,perempuan',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg|max:2000',
            'visi_misi' => 'required|string',
        ]);
    
        $candidate = Candidate::findOrFail($id);
        $candidate->name = $validateData['name'];
        $candidate->gender = $validateData['gender'];
        $candidate->visi_misi = $validateData['visi_misi'];
    
        if ($request->hasFile('photo')) {
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
        $candidate->delete();
    
        return redirect()->route('adminCandidate')->with('success', 'Data Candidate berhasil dihapus');
    }

    
}
