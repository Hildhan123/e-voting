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
                            <label>Nama Election</label>
                            <select name="election_id" class="form-select @error('election_id') is-invalid @enderror">
                                @foreach ($election as $list)
                                    <option value="{{ $list->id }}" {{ $candidate->election_id === $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
                                @endforeach
                            </select>
                            @error('election_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Candidate</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $candidate->name) }}" placeholder="Nama Candidate">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="laki_laki" {{ old('gender', $candidate->gender) === 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender', $candidate->gender) === 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Unggah Foto</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                            <small style="color: red; margin-top: 5px; display: block;">*Jika tidak ingin merubah foto, biarkan saja</small>
                            <small style="color: red; display: block;">*Ukuran photo akan menjadi 3x4</small>
                            <small style="color: red; display: block;">*Ukuran photo maksimal 2 MB</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Visi Misi</label>
                            <textarea name="visi_misi" class="form-control @error('visi_misi') is-invalid @enderror" placeholder="Visi-Misi">{{ old('visi_misi', $candidate->visi_misi) }}</textarea>
                            @error('visi_misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Simpan</button>
                    </form>                                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
