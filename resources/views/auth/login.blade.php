<!DOCTYPE html>
<html lang="en">
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <title>Log In | Sorobonno Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS, ERP, etc." name="description" />
    <meta content="Your Name" name="author" />
    <link rel="shortcut icon" href="{{ URL::to('assets/images/etl.png') }}">
    <script src="{{ asset('backend/js/config.js') }}"></script>
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 d-none d-lg-block p-2">
                            <img src="{{ asset('backend/images/user.png') }}" alt="" class="img-fluid rounded h-200">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <a href="{{ url('/') }}" class="logo-light">
                                        <img src="{{$siteSetting->site_preview_image}}" alt="logo" height="80">
                                    </a>
                                    <a href="{{ url('/') }}" class="logo-dark">
                                        <img src="{{$siteSetting->site_preview_image}}" alt="dark logo" height="80">
                                    </a>
                                </div>
                                <div class="p-4 pt-0 my-auto">
                                    <h4 class="fs-20">Sign In</h4>
                                    <p class="text-muted mb-3">Enter your email address and password to access
                                        the admin.
                                    </p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email address</label>
                                            <input class="form-control" type="email" id="emailaddress" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                                        </div>
                                        <div class="mb-3">
                                            <a href="#" class="text-muted float-end"><small>Forgot your password?</small></a>
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" required id="password" name="password" placeholder="Enter your password">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="ri-eye-fill" id="eyeIcon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span> </button>
                                        </div><br>
                                        <div class="mb-0 text-start">
                                            <a class="btn btn-soft-danger w-100"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Join Platform</span> </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer footer-alt fw-medium">
    <span class="text-dark">
        <script>document.write(new Date().getFullYear())</script> © Powered By CoderNetix.
    </span>
</footer>
<script src="{{ asset('backend/js/vendor.min.js') }}"></script>
<script src="{{ asset('backend/js/app.min.js') }}"></script>
<script>
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const togglePasswordButton = document.getElementById('togglePassword');

    togglePasswordButton.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Change eye icon based on password visibility
        eyeIcon.classList.toggle('ri-eye-fill');
        eyeIcon.classList.toggle('ri-eye-off-fill');
    });
</script>
</body>
</html>
