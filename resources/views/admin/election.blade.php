@extends('layouts.app')

@section('title', 'Admin - Daftar Election')
@section('election', 'active')
@section('content')
<div class="container-fluid">
<h1 class="h3 text-gray-800">Tabel Election</h1>
<p>Ini merupakan tabel dari beberapa Election</p>
<p style="color: red;">*Hanya ada 1 election yang aktif. Jika ada dua atau lebih election yang aktif, maka election dengan status aktif pertama yang akan dipilih</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6 text-right">
            <a href="{{Route('adminElectionCreate')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i>Tambah</a>
        </div>
    </div>
</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Tanggal Dimulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elections as $election)
                    <tr>
                        <td data-title="name">{{ $election->name }}</td>
                        <td data-title="description">{{ $election->description }}</td>
                        <td data-title="start_date">{{ \Carbon\Carbon::parse($election->start_date)->format('Y-m-d') }}</td>
                        <td data-title="end_date">{{ \Carbon\Carbon::parse($election->end_date)->format('Y-m-d') }}</td>
                        <td data-title="status">{{ $election->status }}</td>
                        <td data-title="Aksi" align="center">
                            <a href="{{ route('adminElectionEdit', ['id' => $election->id]) }}"><i class="fas fa-edit"></i></a> | 
                            <a href="{{ route('adminElectionDelete', ['id' => $election->id]) }}" class="modul-hapus"><i class="fas fa-trash" style="color: red"></i></a>

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
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus?</p>
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


