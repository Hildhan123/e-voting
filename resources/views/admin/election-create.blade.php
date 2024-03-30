@extends('layouts.app')
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
                    <form action="" method="POST" action="{{Route('adminElectionStore')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{old('name')}}" placeholder="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" value="{{old('description')}}" placeholder="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" value="{{old('start_date')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="{{old('end_date')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-select">
                        <option value="aktif" selected>Aktif</option>
                        <option value="selesai">Selesai</option>
                        <option value="ditutup">Ditutup</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save" style="margin-right: 5px;"></i>Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection