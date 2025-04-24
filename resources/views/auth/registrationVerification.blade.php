<html>
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <title>User Verification | Digital Cheap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS, ERP, etc." name="description" />
    <meta content="Your Name" name="author" />
    <link rel="shortcut icon" href="{{$siteSetting? $siteSetting->favicon:''}}">
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
                            <img src="{{ asset('backend/images/verification.png') }}" alt="" class="img-fluid rounded h-200">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                @if(!empty($siteSetting))
                                    <div class="auth-brand p-4">
                                        <a href="{{asset($siteSetting->logo)}}" class="logo-light">
                                            <img src="#" alt="logo" height="100">
                                        </a>
                                        <a href="#" class="logo-dark">
                                            <img src="{{asset($siteSetting->logo)}}" alt="dark logo" height="100">
                                        </a>
                                    </div>
                                @endif
                                <div class="p-4 pt-0 my-auto">
                                    <h4 class="fs-20">Account Verification</h4>
                                    <p class="text-muted mb-3">Verification Your Account And Join Sorobonno.
                                    </p>
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    <form method="post" action="{{route('account.verify.complete')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Verification Code</label>
                                            <input class="form-control" type="number" name="verification_code" value="{{ old('verification_code') }}" required placeholder="Enter your code">
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Verification</span> </button>
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
        <script>document.write(new Date().getFullYear())</script> © Powered By CoderNetix
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
        eyeIcon.classList.toggle('ri-eye-fill');
        eyeIcon.classList.toggle('ri-eye-off-fill');
    });
</script>
</body>
</html>
