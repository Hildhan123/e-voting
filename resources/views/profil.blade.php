
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{route('profilHandler')}}">
    @csrf
    <input type="text" name="name" placeholder="nama" value="{{Auth::user()->name}}">
    <input type="email" name="email" placeholder="email" value="{{Auth::user()->email}}">
    <input type="text" value="{{Auth::user()->gender}}" disabled>
    <input type="text" value="{{Auth::user()->role}}" disabled>
    <input type="submit">
</form>
<form method="POST" action="{{route('changePassword')}}">
    @csrf
    <input type="password" name="current_password"> 
    <input id="password" type="password" name="password">
    <input id="password-confirm" type="password" name="password_confirmation">
    <input type="submit">
</form>
