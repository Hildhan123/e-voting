<form method="POST" action="{{ route('adminLoginHandler') }}">
@csrf
<input type="text" name="name" value="{{ old('name') }}" required autocomplete="name">
<input type="password" name="password" value="{{ old('password')}}" required autocomplete="password">
<input type="submit">
</form>