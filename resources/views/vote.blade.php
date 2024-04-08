@extends('layouts.app-user')

@section('vote', 'active')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h3 style="text-align: center;" ><strong>{{ $election->name }}</strong></h3>
        <br>
            <small style="color: blue;">Tanggal Dimulai : {{ \Carbon\Carbon::parse($election->start_date)->format('Y-m-d') }}</small> <br>
            <small style="color: red;">Tanggal Berakhir : {{ \Carbon\Carbon::parse($election->end_date)->format('Y-m-d') }}</small>

        <hr class="divider" style="border-top: 2px solid black;">
        @if (!$vote)
        <p style="text-align: center;">Tentukan pilihan anda sekarang. Karena pilihan anda sangat berharga untuk kami, Terimakasih <i class="far fa-smile-wink"></i></p>
        

            <div class="row justify-content-center" style="display: flex; flex-wrap: wrap;" >
            @foreach ($candidates as $candidate)
            <div class="col-md-3 mb-4" style="flex: 1 1 80%; margin: 25px 15px;">
                <div class="card">
                    <a href="#" class="candidate-link" data-toggle="modal" data-target="#candidateModal{{$candidate->id}}">
                        <img src="{{ asset($candidate->photo) }}" class="card-img-top" alt="{{ $candidate->name }}">
                        <div class="card-body" style="{{ $candidate->gender == 'perempuan' ? 'background-color: pink; color: black' : 'background-color: blue; color: white' }}">
                            <h5 class="card-title text-center">{{ $candidate->name }}</h5>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
            </div>

            @else
                <p style="text-align: center;">Terimakasih atas pilihan anda &nbsp; <img src="{{{ asset('template/img/ilustration-thankyou.png') }}}" alt="" style="width: 15vw; max-width: 50px;"></p>
                
                <div class="row justify-content-center" style="display: flex; flex-wrap: wrap;" >
                @foreach ($candidates as $candidate)
                    <div class="col-md-3 mb-4" style="flex: 1 1 80%; margin: 25px 15px;">
                        <div class="card">
                            @if ($vote && $vote->candidate_id == $candidate->id)
                                <!-- If the candidate is selected, show the normal image -->
                                <div style="position: relative;">
                                    <img src="{{ asset($candidate->photo) }}" class="card-img-top" alt="{{ $candidate->name }}">
                                    <div style="position: absolute; top: 0; right: 0; transform: translate(40%, -55%); z-index: 1;">
                                        <img src="{{{ asset('template/img/icon-coblos.png') }}}" class="nail-icon" alt="" style="width: 25vw; max-width: 150px;">
                                    </div>
                                </div>
                            @else
                                <!-- If the candidate is not selected, show the image with "X" -->
                                <div style="position: relative;">
                                    <img src="{{ asset($candidate->photo) }}" class="card-img-top" alt="{{ $candidate->name }}" style="filter: grayscale(100%);">
                                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                        <span style="font-size: 6rem; color: red;">X</span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body" style="{{ $vote && $vote->candidate_id == $candidate->id ? 'background-color: blue; color: white;' : (($candidate->gender == 'perempuan' && Auth::user()->gender == 'perempuan') ? 'background-color: pink; color: black;' : (($candidate->gender == 'laki-laki' && Auth::user()->gender == 'laki-laki') ? 'background-color: blue; color: white;' : 'background-color: grey; color: #e2e8f0;')) }}">
                                <h5 class="card-title text-center">{{ $candidate->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@foreach ($candidates as $candidate)
<!-- Modal -->
<div class="modal fade" id="candidateModal{{$candidate->id}}" tabindex="-1" role="dialog" aria-labelledby="candidateModalLabel{{$candidate->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset($candidate->photo) }}" class="img-fluid" alt="{{ $candidate->name }}" style="border-radius: 5%; max-width: auto; height: auto;">
                    </div>
                    <div class="col-md-6">
                        <h4 class="modal-title text-center" id="candidateModalLabel{{$candidate->id}}" style="color: black;"><strong>{{ $candidate->name }}</strong></h4>
                        <hr class="divider" style="border-top: 1px solid black;">
                        <h5 style="text-align: center; color: black;"><strong>Visi & Misi:</strong></h5>
                        <small style="display: block; text-align: center; color: black;">{{ $candidate->visi_misi }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display: flex;">
                <form action="{{ route('voteHandler') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vote" value="{{ $candidate->id }}">
                    <small>Apakah anda yakin dengan pilihan anda?</small>
                    @if (Auth::user()->gender == $candidate->gender || Auth::user()->role == 'guru') 
                        <button type="submit" class="btn btn-primary">Yakin</button>
                    @else
                        <small style="color: red;">Anda tidak bisa memilih kandidat ini.</small>
                    @endif
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach



@endsection