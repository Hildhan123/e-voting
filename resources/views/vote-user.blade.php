@extends('layouts.app-user')

@section('vote', 'active')
@section('content')

<div class="container-fluid">
    Vote Candidate
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1>{{ $election->name }}</h1>
            <p>{{ $election->description }}</p>
            <p>Tanggal Dimulai : {{ \Carbon\Carbon::parse($election->start_date)->format('Y-m-d') }}</p>
            <p>Tanggal Berakhir : {{ \Carbon\Carbon::parse($election->end_date)->format('Y-m-d') }}</p>

            <button type="submit" class="btn btn-primary mt-3" href="{{Route('vote')}}">Lihat Kandidat</button>

        </div>
    </div>
</div>
@endsection
