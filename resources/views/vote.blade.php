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

            @if (!$vote)
                <form method="POST" action="{{ route('voteHandler') }}">
                    @csrf
                    <select name="vote" class="form-control">
                        <option value="">Pilih Kandidat</option>
                        {{-- Menampilkan opsi untuk kandidat laki-laki --}}
                        <optgroup label="Kandidat Laki-laki">
                            @foreach ($candidates->where('gender', 'laki_laki') as $candidate)
                                <option value="{{ $candidate->id }}" {{ Auth::user()->gender != 'laki_laki' ? 'disabled' : '' }}>
                                    {{ $candidate->name }}
                                </option>
                            @endforeach
                        </optgroup>

                        {{-- Menampilkan opsi untuk kandidat perempuan --}}
                        <optgroup label="Kandidat Perempuan">
                            @foreach ($candidates->where('gender', 'perempuan') as $candidate)
                                <option value="{{ $candidate->id }}" {{ Auth::user()->gender != 'perempuan' ? 'disabled' : '' }}>
                                    {{ $candidate->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            @else
                <p>Anda Sudah Memilih</p>
            @endif
        </div>
    </div>
</div>
@endsection
