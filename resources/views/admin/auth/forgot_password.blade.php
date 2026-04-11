<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/images/logo.ico') }}">
        <title>Cute Fashions</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/css/admin_custom.css') }}">
    </head>
    <body class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="login_image">
                        <img src="{{ asset('admin_assets/images/logo-dark.svg') }}" alt="logo" />
                    </div>
                    <div class="login_paragraph">
                        <p>Sign in to start your session</p>
                    </div>
                    <div class="login_main_image">
                        <img src="{{ asset('admin_assets/images/illustration-03.svg') }}" alt="logo" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="login_box">
                        <div class="card_header">
                            <h2>{{ __('Reset Password') }}</h2>
                        </div>
                        <div class="card_body">
                            <form method="POST" action="{{ route('admin.password.email') }}">
                                @csrf
                                <div class="input_group">
                                    <label>{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                    <div class="input_icon">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g opacity="0.5">
                                                <path d="M19.2516 3.30005H2.75156C1.58281 3.30005 0.585938 4.26255 0.585938 5.46567V16.6032C0.585938 17.7719 1.54844 18.7688 2.75156 18.7688H19.2516C20.4203 18.7688 21.4172 17.8063 21.4172 16.6032V5.4313C21.4172 4.26255 20.4203 3.30005 19.2516 3.30005ZM19.2516 4.84692C19.2859 4.84692 19.3203 4.84692 19.3547 4.84692L11.0016 10.2094L2.64844 4.84692C2.68281 4.84692 2.71719 4.84692 2.75156 4.84692H19.2516ZM19.2516 17.1532H2.75156C2.40781 17.1532 2.13281 16.8782 2.13281 16.5344V6.35942L10.1766 11.5157C10.4172 11.6875 10.6922 11.7563 10.9672 11.7563C11.2422 11.7563 11.5172 11.6875 11.7578 11.5157L19.8016 6.35942V16.5688C19.8703 16.9125 19.5953 17.1532 19.2516 17.1532Z" fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="d-flex">
                                    <div class="">
                                        <button type="submit">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                        <a href="{{ url()->previous() }}">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                            @if (session('status'))
                                <div class="alert alert-success mt-5" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>