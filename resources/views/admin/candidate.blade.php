<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate</title>
</head>
<body>
    Candidate
    <a href="{{route('adminCandidateCreate')}}">Candidate Create</a>
    <table>
        <thead>
            <tr>
                <th>Nama Candidate</th>
                <th>Jumlah Vote</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $candidate)
                <tr>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->vote_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>