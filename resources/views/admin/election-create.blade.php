<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Election Create</title>
</head>
<body>
    <form method="POST" action="{{Route('adminElectionStore')}}">
        @csrf
        <input type="text" name="name" value="{{old('name')}}" placeholder="name">
        <textarea type="text" name="description" value="{{old('description')}}" placeholder="description"></textarea>
        <input type="date" name="start_date" value="{{old('start_date')}}">
        <input type="date" name="end_date" value="{{old('end_date')}}">
        <select name="status">
            <option value="aktif" selected>Aktif</option>
            <option value="selesai">Selesai</option>
            <option value="ditutup">Ditutup</option>
        </select>
        <input type="submit">
    </form>
</body>
</html>