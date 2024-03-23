<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Candidate Create</title>
</head>
<body>
    <form method="POST" action="{{route('adminCandidateStore')}}" enctype="multipart/form-data">
        @csrf
        <select name="election_id">
            @foreach ($election as $list)
                <option value="{{$list->id}}">{{$list->id}}</option>
            @endforeach
        </select>
        <input type="text" name="name" value="{{old('name')}}" placeholder="name">
        <select name="gender">
            <option value="laki_laki" selected>Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select>
        <input type="file" name="photo">
        <textarea type="text" name="visi_misi" placeholder="visi-misi">{{old('visi_misi')}}</textarea>
        <input type="submit">
    </form>
</body>
</html>