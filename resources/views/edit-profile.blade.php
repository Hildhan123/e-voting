@extends('layouts.app-user')

@section('content')
    <div class="container">
        <a href="{{ route('profil') }}">
            <i class="fas fa-arrow-left"></i> Kembali ke Profil
        </a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Edit Profile') }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mt-3">
                        <form method="POST" action="{{ route('profilHandler') }}">
                                @csrf
                                @method('PUT')

                                <!-- Input Name, Email, Gender, Role -->
                                <!-- Pastikan untuk menambahkan value dari data yang ada -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    <select id="gender" class="form-select" name="gender" disabled>
                                        <option value="Laki-laki" @if(Auth::user()->gender == 'Laki-laki') selected @endif>Laki-laki</option>
                                        <option value="Perempuan" @if(Auth::user()->gender == 'Perempuan') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="role">{{ __('Role') }}</label>
                                        <select id="role" class="form-select" name="role" disabled>
                                            <option value="Siswa" @if(Auth::user()->role == 'Siswa') selected @endif>Siswa</option>
                                            <option value="Guru" @if(Auth::user()->role == 'Guru') selected @endif>Guru</option>
                                        </select>
                                </div>
                                <!-- Tombol Simpan -->
                                <button type="submit" class="btn btn-success float-right btn-responsive mt-3 mr-3 mb-3"> <i class="fas fa-save" style="margin-right: 5px;"></i>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
