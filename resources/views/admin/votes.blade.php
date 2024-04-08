<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Votes</title>
</head>
<body>
    <form method="POST" action="{{route('adminVotesHandler')}}">
        @csrf
        <select name="election_id">
            @foreach ($election as $list)
                <option value="{{ $list->id }}" {{ old('election_id') == $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
            @endforeach
        </select>

        <input type="submit">
    </form>

    <!-- Menampilkan statistik sederhana kandidat yang memunculkan total suara dan berapa persen dari semua kandidat di election tersebut -->
    @if ($candidates)
        <h3>Total Votes for Each Candidate</h3>
        <ul>
            @foreach ($candidates as $candidate)
                <li>{{ $candidate->name }}: {{ $candidate->votes_count }} votes ({{ $candidate->vote_percentage }}%)</li>
            @endforeach
        </ul>
    @endif
</body>
</html>