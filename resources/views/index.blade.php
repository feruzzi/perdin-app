<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PERDIN APP</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/Syntax_Error.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/Syntax_Error.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/extensions/@icon/dripicons/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">

    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
</head>

<body>
    <div id="auth">

        <div class="d-flex justify-content-center align-items-center mt-5">
            <form action="{{ url('login/auth') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4 class="card-title">Login Perdin-App</h4>
                            <div class="row">
                                @error('error')
                                    <div class="alert alert-light-danger color-danger">Username dan Password Tidak
                                        Ditemukan <i class="bi bi-exclamation-circle"></i></div>
                                @enderror
                                <div class="col-12 mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" placeholder="Username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="Password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mx-3 mb-3">
                        <button class="btn btn-primary w-100">Login</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
