<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote Candidate</title>
</head>
<body>
    Vote Candidate

    <h1>{{$election->name}}</h1>
    <p>{{$election->description}}</p>
    <p>Tanggal Dimulai : {{\Carbon\Carbon::parse($election->start_date)->format('Y-m-d')}}</p>
    <p>Tanggal Berakhir : {{\Carbon\Carbon::parse($election->end_date)->format('Y-m-d')}}</p>

    @if(!$vote)
    <form method="POST" action="{{Route('voteHandler')}}">
        @csrf
        <select name="vote">
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
        <input type="submit">
    </form>
    @else
    Anda Sudah Memilih
    @endif
</body>
</html>