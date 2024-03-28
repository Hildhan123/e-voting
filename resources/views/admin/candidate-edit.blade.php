@extends('layouts.app')
@section('candidate', 'active')

@section('content')
<div class="container-fluid">
    <!-- Approach -->
    <div class="row">
        <div>
            <a href="{{ route('adminCandidate') }}"><i class="fas fa-long-arrow-alt-left" style="margin-right: 5px;"></i>Back</a>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Candidate</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminCandidateUpdate', ['id' => $candidate->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>ID Election</label>
                            <select name="candidate_id" class="form-control">
                                <option value="{{ $candidate->id }}">{{ $candidate->id }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="laki_laki" {{ $candidate->gender === 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $candidate->gender === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Unggah Foto</label>
                            <input type="file" name="photo" class="form-control">
                            <small style="color: red; margin-top: 5px; display: block;">*Jika tidak ingin merubah foto, biarkan saja</small>
                            <small style="color: red; display: block;">*Ukuran photo akan menjadi 3x4</small>
                        </div>
                        <div class="form-group">
                            <label>Visi Misi</label>
                            <textarea name="visi_misi" class="form-control" placeholder="Visi-Misi">{{ $candidate->visi_misi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Voting</label>
                            <input type="number" name="jumlah_voting" class="form-control" placeholder="Jumlah-Voting"></input>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
