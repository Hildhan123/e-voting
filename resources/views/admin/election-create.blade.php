@extends('layouts.app')

@section('title', 'Admin - Tambah Election')
@section('election', 'active')
@section('content')
<div class="container-fluid">
    <!-- Approach -->
    <div class="row">
        <div>
            <a href="{{ route('adminElection') }}"><i class="fas fa-long-arrow-alt-left" style="margin-right: 5px;"></i>Back</a>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Election</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('adminElectionStore') }}">
                        @csrf
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Election (Pemilihan)" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" placeholder="Deskripsi" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="laki_laki" {{ old('gender') == 'laki_laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="aktif" selected>Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="ditutup">Ditutup</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Tambah</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection