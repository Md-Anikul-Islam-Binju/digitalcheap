<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Maintenance | Sorobonno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Sorobonno" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/images/etl.png') }}">
    <script src="{{ asset('backend/js/config.js')}}"></script>
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="mb-4">
                	<img src="{{ URL::to('backend/images/svg/under_maintenance.png')}}" alt="" class="img-fluid">
                </div>
                <div class="text-center">
                    <h2 class="mb-3 text-muted">Sorry we are under maintenance</h2>
                    <p class="text-dark-emphasis fs-15 mb-1">Our website currently undergoing maintenance.</p>
                    <a href="{{ route('login') }}">
                        <p  class="btn btn-info">Now You Just Login Admin.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Powered By CoderNetix.
        </span>
</footer>
<script src="{{ asset('backend/js/vendor.min.js')}}"></script>
<script src="{{ asset('backend/js/app.min.js')}}"></script>

</body>

</html>
