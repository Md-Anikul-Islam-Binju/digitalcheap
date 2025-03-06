<!DOCTYPE html>
<html lang="en">
@php
    $siteSetting = DB::table('site_settings')->first();
@endphp
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Sorborno Admin</title>
    <link rel="shortcut icon" href="{{$siteSetting? $siteSetting->favicon:''}}">
    <meta property="og:image" content="{{$siteSetting? $siteSetting->site_preview_image:''}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Sorobonno" name="author" />
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.ico')}}">
    <!-- Select2 css -->
    <link href="{{asset('backend/vendor/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
    <!-- Datatables css -->
    <link href="{{asset('backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('backend/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}">
    <script src="{{asset('backend/js/config.js')}}"></script>
    <link href="{{asset('backend/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{asset('backend/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- Custom Css File here --}}
    <script src="{{asset('backend/js/chart.js')}}"></script>
    <script src="{{asset('backend/js/echarts.min.js')}}"></script>
</head>
<body>
<div class="wrapper">
    <div class="navbar-custom">
        <div class="topbar container-fluid">
            <div class="d-flex align-items-center gap-1">
                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <ul class="topbar-menu d-flex align-items-center gap-3">
                <li class="dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="ri-search-line fs-22"></i>
                    </a>
                </li>
                <li class="d-none d-sm-inline-block">
                    <div class="nav-link" id="light-dark-mode">
                        <i class="ri-moon-line fs-22"></i>
                    </div>
                </li>
                <li class="dropdown">
                    @php
                       $admin = auth()->user();
                    @endphp
                    <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <span class="d-lg-block d-none">
                              <h5 class="my-0 fw-normal">{{$admin->name}}
                                  <i class="ri-arrow-down-s-line d-none d-sm-inline-block align-middle"></i>
                              </h5>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <a href="#" class="dropdown-item">
                            <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            <span>My Account</span>
                        </a>

                        <a href="{{route('password.edit')}}" class="dropdown-item">
                            <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            <span>Change Password</span>
                        </a>

                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ri-logout-box-line fs-18 align-middle me-1"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="leftside-menu">
        @if($siteSetting !=null)
        <a href="{{route('dashboard')}}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{URL::to($siteSetting->logo)}}" alt="logo" style="height: 50px;">
            </span>
            <span class="logo-sm ">
                <img class="rounded" src="{{URL::to($siteSetting->favicon)}}" alt="small logo" style="height: 40px;">
            </span>
        </a>
        @endif

        <div class="h-100" id="leftside-menu-container" data-simplebar>
            <ul class="side-nav">
                <li class="side-nav-title">Main</li>
                <li class="side-nav-item">
                    <a href="{{route('dashboard')}}" class="side-nav-link">
                        <i class="ri-dashboard-3-line"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @can('basic-menu-list')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                        <i class="ri-pages-line"></i>
                        <span> Site Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPages">
                        <ul class="side-nav-second-level">
                            @can('slider-list')
                            <li>
                                <a href="{{route('slider.section')}}">Slider</a>
                            </li>
                            @endcan

                            @can('currency-list')
                                <li>
                                    <a href="{{route('currency.section')}}">Currency</a>
                                </li>
                            @endcan

                            @can('service-list')
                                <li>
                                    <a href="{{route('service.section')}}">Service</a>
                                </li>
                            @endcan

                            @can('blog-list')
                                <li>
                                    <a href="{{route('blog.section')}}">Blog</a>
                                </li>
                            @endcan

                            @can('review-list')
                                <li>
                                    <a href="{{route('review.section')}}">Review</a>
                                </li>
                            @endcan

                            @can('partner-list')
                                <li>
                                    <a href="{{route('partner.section')}}">Partner</a>
                                </li>
                            @endcan

                            @can('join-category-list')
                                <li>
                                    <a href="{{route('join.category.section')}}">Join Category</a>
                                </li>
                            @endcan

                            @can('country-list')
                                <li>
                                    <a href="{{route('country.section')}}">Country</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('manage-product-section')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarPagesProduct" aria-expanded="false" aria-controls="sidebarPagesProduct" class="side-nav-link">
                        <i class="ri-pages-line"></i>
                        <span> Manage Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPagesProduct">
                        <ul class="side-nav-second-level">

                            @can('category-list')
                                <li>
                                    <a href="{{route('category.section')}}">Category</a>
                                </li>
                            @endcan

                            @can('product-list')
                                <li>
                                    <a href="{{route('product.section')}}">Product</a>
                                </li>
                            @endcan

                            @can('package-list')
                                <li>
                                    <a href="{{route('package.section')}}">Package</a>
                                </li>
                            @endcan

                            @can('coupon-list')
                                <li>
                                    <a href="{{route('coupon.section')}}">Coupon</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan



                @can('user-manage')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPagesUser" aria-expanded="false" aria-controls="sidebarPagesUser" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> User </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPagesUser">
                            <ul class="side-nav-second-level">


                                @can('active-user-list')
                                    <li>
                                        <a href="{{route('active.user')}}">Active User</a>
                                    </li>
                                @endcan

                                @can('inactive-user-list')
                                    <li>
                                        <a href="{{route('inactive.user')}}">Inactive User</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan



            @can('settings-on-site')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPagesSetting" aria-expanded="false" aria-controls="sidebarPagesSetting" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Setting </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPagesSetting">
                            <ul class="side-nav-second-level">


                                @can('site-setting')
                                    <li>
                                        <a href="{{route('site.setting')}}">Site Setting</a>
                                    </li>
                                @endcan

                                @can('faq-list')
                                    <li>
                                        <a href="{{route('faq.section')}}">Faq</a>
                                    </li>
                                @endcan



                                @can('terms-and-condition-list')
                                    <li>
                                        <a href="{{route('admin.termsAndCondition')}}">Terms & Condition</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan


                @can('account-setting')
                    <li class="side-nav-item">
                        <a href="{{route('account.setting')}}" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Account </span>
                        </a>
                    </li>
                @endcan


               @can('live-chat')
                <li class="side-nav-item">
                    <a href="{{url('chatify')}}" class="side-nav-link">
                        <i class="ri-chat-1-line"></i>
                        <span> Live Chat </span>
                    </a>
                </li>
                @endcan

                @can('my-affiliate')
                    <li class="side-nav-item">
                        <a href="{{route('my.affiliate')}}" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> My Affiliate </span>
                        </a>
                    </li>
                @endcan







                @can('order-manage')
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarPagesOrder" aria-expanded="false" aria-controls="sidebarPagesOrder" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Order </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarPagesOrder">
                            <ul class="side-nav-second-level">


                                @can('order-list')
                                    <li>
                                        <a href="{{route('order.list')}}">Order History</a>
                                    </li>
                                @endcan

                                @can('order-active')
                                    <li>
                                        <a href="{{route('order.active')}}">Active Subscription</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan


                @can('pricing-list')
                    <li class="side-nav-item">
                        <a href="{{url('/products')}}"  target="_blank" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Pricing </span>
                        </a>
                    </li>
                @endcan

                @can('use-guide')
                    <li class="side-nav-item">
                        <a href="{{url('/how-to-use')}}" target="_blank" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> How To Use </span>
                        </a>
                    </li>
                @endcan

                @can('use-guide')
                    <li class="side-nav-item">
                        <a href="{{url('/how-to-access')}}" target="_blank" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> How To Access </span>
                        </a>
                    </li>
                @endcan



                @can('extension-list')
                    <li class="side-nav-item">
                        <a href="#" class="side-nav-link">
                            <i class="ri-drag-move-fill"></i>
                            <span> Extension </span>
                        </a>
                    </li>
                @endcan






                @can('user-order-list')
                    <li class="side-nav-item">
                        <a href="{{route('user.list')}}" class="side-nav-link">
                            <i class="ri-user-3-line"></i>
                            <span> Manage  User Order </span>
                        </a>
                    </li>
                @endcan








                @can('role-and-permission-list')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarPages1" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                        <i class="ri-rotate-lock-line"></i>
                        <span>Permission Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPages1">
                        <ul class="side-nav-second-level">
                            @can('user-list')
                            <li>
                                <a href="{{url('users')}}">Create User</a>
                            </li>
                            @endcan
                            @can('role-list')
                            <li>
                                <a href="{{url('roles')}}">Role & Permission</a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
              @yield('admin_content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>document.write(new Date().getFullYear())</script> © Powered By CoderNetix</b>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<script src="{{asset('backend/js/vendor.min.js')}}"></script>
<!-- Dropzone File Upload js -->
<script src="{{asset('backend/vendor/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{asset('backend/js/pages/fileupload.init.js')}}"></script>
<!--  Select2 Plugin Js -->
<script src="{{asset('backend/vendor/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('backend/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('backend/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Ckeditor Here -->
<script src="{{asset('backend/js/sdmg.ckeditor.js')}}"></script>
<!-- Datatables js -->
<script src="{{asset('backend/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
<!-- Datatable Demo Aapp js -->
<script src="{{asset('backend/js/pages/datatable.init.js')}}"></script>
<script src="{{asset('backend/js/pages/dashboard.js')}}"></script>
<script src="{{asset('backend/js/app.min.js')}}"></script>
<script src="{{asset('backend/js/summernote-bs5.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Initialize Summernote for the main textarea
        $('#summernote').summernote({
            height: 200,
        });

        $('#summernoteBn').summernote({
            height: 200,
        });

        // Initialize Summernote for edit modals
        $('[id^=summernoteEdit]').each(function () {
            $(this).summernote({
                height: 200,
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-control[multiple]').select2({
            allowClear: true
        });
    });
</script>
</body>
</html>
