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
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Candidate</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST" action="{{route('adminCandidateStore')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Id Election</label>
                        <select name="election_id" class="form-control">
                            @foreach ($election as $list)
                                <option value="{{$list->id}}">{{$list->id}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="laki_laki" selected>Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unggah Foto</label>
                        <input type="file" name="photo" class="form-control">
                        <small style="color: red; margin-top: 5px; display: block;">*Ukuran photo akan menjadi 3x4</small>
                    </div>
                    <div class="form-group">
                        <label>Visi Misi</label>
                        <textarea type="text" name="visi_misi" class="form-control" placeholder="visi-misi">{{old('visi_misi')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Vote</label>
                        <input type="text" name="jumlah_vote" class="form-control" placeholder="jumlah_vote"></input>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection