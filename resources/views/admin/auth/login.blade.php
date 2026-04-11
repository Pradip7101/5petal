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
                            <h2>Sign In to admin</h2>
                        </div>
                        <div class="card_body">
                            <form action="{{ route('admin.login.post') }}" method="POST">
                                @csrf
                                <div class="input_group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
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
                                <div class="input_group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password">
                                    <div class="input_icon">
                                        <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.5">
                                            <path d="M16.1547 6.80626V5.91251C16.1547 3.16251 14.0922 0.825009 11.4797 0.618759C10.0359 0.481259 8.59219 0.996884 7.52656 1.95938C6.46094 2.92188 5.84219 4.29688 5.84219 5.70626V6.80626C3.84844 7.18438 2.33594 8.93751 2.33594 11.0688V17.2906C2.33594 19.5594 4.19219 21.3813 6.42656 21.3813H15.5016C17.7703 21.3813 19.6266 19.525 19.6266 17.2563V11C19.6609 8.93751 18.1484 7.21876 16.1547 6.80626ZM8.55781 3.09376C9.31406 2.40626 10.3109 2.06251 11.3422 2.16563C13.1641 2.33751 14.6078 3.98751 14.6078 5.91251V6.70313H7.38906V5.67188C7.38906 4.70938 7.80156 3.78126 8.55781 3.09376ZM18.1141 17.2906C18.1141 18.7 16.9453 19.8688 15.5359 19.8688H6.46094C5.05156 19.8688 3.91719 18.7344 3.91719 17.325V11.0688C3.91719 9.52189 5.15469 8.28438 6.70156 8.28438H15.2953C16.8422 8.28438 18.1141 9.52188 18.1141 11V17.2906Z" fill=""></path>
                                            <path d="M10.9977 11.8594C10.5852 11.8594 10.207 12.2031 10.207 12.65V16.2594C10.207 16.6719 10.5508 17.05 10.9977 17.05C11.4102 17.05 11.7883 16.7063 11.7883 16.2594V12.6156C11.7883 12.2031 11.4102 11.8594 10.9977 11.8594Z" fill=""></path>
                                        </g>
                                        </svg>
                                    </div>
                                    <div class="input_delete">
                                        <svg class="fill-current" width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/></svg>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember" name="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 forger_paragraph">
                                        <a href="{{ route('admin.password.request') }}">I forgot my password?</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>