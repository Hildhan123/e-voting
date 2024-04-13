@extends('layouts.app-user')

@section('title', 'User - Profile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <!-- Informasi Profil -->
                        <div id="profile-info">
                            <div class="text-center">
                            <img class="img-profile rounded-circle"
                                src="{{asset('template/img/undraw_profile.svg')}}" style="width: 150px; height: 150px; border-radius: 50%;" alt="Profile Picture">
                            </div>
                            <div class="mt-3">
                                <p><strong>Nama :</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
                                <p><strong>Gender :</strong> {{ Auth::user()->gender === 'laki_laki' ? 'Laki-Laki' : 'Perempuan' }}</p>
                                <p><strong>Role :</strong> {{ Auth::user()->role }}</p>
                            </div>
                            <a href="{{ route('profilEdit') }}" class="btn btn-primary mt-3 float-right mr-3 mb-3 btn-responsive">Edit</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
