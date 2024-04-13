@extends('layouts.app')

@section('title', 'Admin - Daftar Candidate')
@section('candidate', 'active')
@section('content')
<div class="container-fluid">
<h1 class="h3 text-gray-800">Tabel Candidate</h1>
<p>Ini merupakan tabel dari beberapa Candidate</p>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6 text-right">
            <a href="{{route('adminCandidateCreate')}}"class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i> Tambah</a>
        </div>
    </div>
</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th>Nama Election</th>
                        <th>Name Candidate</th>
                        <th>Gender</th>
                        <th>Foto</th>
                        <th>Visi Misi</th>
                        <th>Jumlah Voting</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($candidates as $candidate)
                    <tr>
                        <td data-title="Election" style="vertical-align: middle;">{{ $candidate->nama_election }}</td>
                        <td data-title="Name" style="vertical-align: middle;">{{ $candidate->name }}</td>
                        <td data-title="Gender" style="vertical-align: middle;">{{ $candidate->gender }}</td>
                        <td data-title="Photo" style="vertical-align: middle;"><img src="{{ asset($candidate->photo) }}" alt="{{ $candidate->name }}" width="125"></td>
                        <td data-title="Visi_Misi" style="vertical-align: middle;">{{ $candidate->visi_misi }}</td>
                        <td data-title="Jumlah_VOting" style="vertical-align: middle;">{{$candidate->votes_count}}</td>
                        <td data-title="Aksi" style="vertical-align: middle;" align="center">
                            <a href="{{ route('adminCandidateEdit', ['id' => $candidate->id]) }}"><i class="fas fa-edit"></i></a> | 
                            <a href="{{ route('adminCandidateDelete', ['id' => $candidate->id]) }}" class="modul-hapus"><i class="fas fa-trash" style="color: red"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Apakah anda yakin ingin menghapusnya?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>pilih "Batal" jika ingin membatalkan, pilih "Yakin" jika tetap ingin menghapus</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelButton">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yakin</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection