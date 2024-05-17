@extends('layouts.app')

@section('title', 'Admin - Progress Vote')
@section('votes', 'active')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <h1 class="h3 mb-2 text-gray-800" style="margin-bottom: 50px; font-size: 100%; font-weight: bold;">Pilih Election</h1>
                <form method="POST" action="{{route('adminVotesHandler')}}">
                    @csrf
                    <div class="form-group">
                        <select name="election_id" class="form-select">
                            @foreach ($election as $list)
                            <option value="{{ $list->id }}" {{ old('election_id') == $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
                            @endforeach
                        </select>
                    </div>       
                    <button type="submit" class="btn btn-primary mt-3 float-right" style="width: 100%; max-width: 200px;"><i class="fas fa-paper-plane"> &nbsp</i>Submit</button>

                </form>
            </div>

            <hr class="divider" style="border-top: 2px solid black; margin-top: 50px;">

            <div class="card-body" style="margin-top: 50px; margin-bottom: 50px" >

            
                @if ($candidates)
                <h3 style="text-align: center; font-size: 1.5em;">Total Suara untuk Setiap Kandidat</h3>
                        <div class="row justify-content-center" style="display: flex; flex-wrap: wrap;" >
                            @foreach ($candidates as $candidate)
                            <div class="col-md-3 mb-4" style="flex: 1 1 80%; margin: 25px 15px;">
                                <div class="card" style="{{ $candidate->gender == 'perempuan' ? 'background-color: pink;' : 'background-color: blue; color: white' }}">
                                <p class="card-text text-center" style="margin-top: 10px; margin-bottom: 10px">{{ $candidate->name }}</p>
                                        <img src="{{ asset($candidate->photo) }}" class="card-img-top" alt="{{ $candidate->name }}" style= "background-color: gray" >
                                        <div class="card-body" style="background-color: white; color: black">
                                            <h5 class="card-title text-center"> Votes : {{ $candidate->votes_count }} ({{ $candidate->vote_percentage }}%)</h5>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                @endif
            </div>    
        </div>  
    </div>
</div>

@endsection