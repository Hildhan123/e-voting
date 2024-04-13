
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center p-5">
                                <img src="{{asset('template/img/logo_tutwuri.png')}}" style="max-width: 85%; height: auto;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                                    </div>
                                    <form method="POST" action="{{ route('adminLoginHandler') }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="username" class="col-md-9 col-form-label text-md-end">Username</label>
                                        </div>
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name">
                                        </div>
                                        <div class ="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                        </div>
                                        <div class="form-group">
                                        <input type="password" class="form-control" name="password" value="{{ old('password')}}" required autocomplete="password">
                                    </div>
                                    @error('login')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                        <div class="form-group d-flex align-items-center">
                                            <div class="custom-control custom-checkbox small">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                            </div>
                                            {{-- <div class="ml-auto">
                                                @if (Route::has('password.request'))
                                                    <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                                @endif
                                            </div> --}}
                                        </div>
                                        <div class="row mb-0">
                                        <div class="col-md-8 offset-md-2">
                                            <input type="submit" class="btn btn-primary btn-user btn-block">
                                        </div>
                                    </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>