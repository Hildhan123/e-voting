@extends('layouts.app-user')

@section('home', 'active')
@section('content')
<div class="container-fluid">
    <div>
        <div class="py-3" style="padding-bottom: 20px;">
            <div class="d-flex align-items-center" style="margin-bottom: -10px;">
                <img src="{{ asset('template/img/ilustration-hp.png') }}" alt="" style="width: 15vw; max-width: 400px;"> &nbsp;
                <div>
                    <!-- Teks untuk tampilan desktop -->
                    <p style="color: black; font-size: 30px; margin-top: -150px; font-weight: bold">Saatnya tentukan pilihan anda !</p>
                    <!-- Teks untuk tampilan mobile -->
                    <p style="color: black; font-size: 3vw; display: none; font-weight: bold">Saatnya tentukan pilihan anda !</p>
                    <img src="{{ asset('template/img/hand.png') }}" alt="" style="width: 5vw; max-width: 35px; margin-left: 15px;">
                    <a href="{{Route('vote')}}" class="btn btn-primary btn-responsive" style="margin-top: -5px; margin-left: 8px; margin-right: 8px; border-radius: 15px;">Vote</a>
                    <img src="{{ asset('template/img/hand-rotate.png') }}" alt="" style="width: 5vw; max-width: 35px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
