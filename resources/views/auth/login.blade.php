<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- <link rel="stylesheet" href="wwwroot/css/site.css" asp-append-version="true" />
    <link rel="stylesheet" href="~/LifeInsuranceCore.styles.css" asp-append-version="true" />*@ -->

    <!-- ===============================================-->
    <!--    assets from dashboard-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('adminassets/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('adminassets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('adminassets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('adminassets/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('adminassets/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('adminassets/assets/js/config.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets from dashboard-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminassets/assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('adminassets/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('adminassets/assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('adminassets/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminassets/assets/toastr/toastr.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/nepali.datepicker.v3.7/css/nepali.datepicker.v3.7.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('adminassets/assets/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminassets/vendors/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminassets/css/custom.css') }}" asp-append-version="true" />


    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative">
                    <img class="bg-auth-circle-shape"
                        src="{{ asset('adminassets/assets/img/icons/spot-illustrations/bg-shape.png') }}" alt=""
                        width="250">
                    <img class="bg-auth-circle-shape-2"
                        src="{{ asset('adminassets/assets/img/icons/spot-illustrations/shape-1.png') }}" alt=""
                        width="150">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7 light">
                                        <div class="z-index-1 position-relative">
                                            <a class="link-light mb-4 font-sans-serif fs-4 d-inline-block fw-bolder"
                                                href="#">Welcome to Nexon Property</a>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <div class="row flex-between-center">
                                            <div class="col-auto">
                                                <h3>Account Login</h3>
                                            </div>
                                        </div>

                                        <!-- Error Message Display -->
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form method="post" action="{{ url('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="card-email">Email address</label>
                                                <input class="form-control" id="card-email" type="email" name="email"
                                                    value="{{ old('email') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="card-password">Password</label>
                                                </div>
                                                <input class="form-control" id="card-password" type="password"
                                                    name="password" required>
                                            </div>
                                            <div class="row flex-between-center">
                                                <div class="col-auto">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="card-checkbox" checked="checked" name="remember">
                                                        <label class="form-check-label mb-0"
                                                            for="card-checkbox">Remember me</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                    name="submit">Log in</button>
                                            </div>
                                        </form>
                                        <a href="/register" class="text-center">I don't have a membership</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts from dashboard-->
    <!-- ===============================================-->

    <script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/jquery-validation/dist/jquery.validate.min.js') }}"
        type="text/javascript">
        </script>
    <script src="{{ asset('adminassets/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.responsive.min.js') }}"
        type="text/javascript">
        </script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.buttons.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('adminassets/wwwroot/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('adminassets/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('adminassets/assets/js/theme.js') }}"></script>
    <script src="{{ asset('adminassets/assets/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('adminassets/assets/jquery-mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/scripts/language.js') }}"></script>
    <script src="{{ asset('adminassets/scripts/common.js') }}"></script>
    <script src="{{ asset('adminassets/assets/js/flatpickr.js') }}"></script>

    <script type="text/javascript">
        InitializeUnicodeNepali();
    </script>

    <script>
        $(function () {
            var current = location.pathname;
            $('.navbar .nav-item .nav-link ').each(function () {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href').indexOf(current) !== -1) {
                    $this.closest("nav-link.dropdown-indicator.collapsed").removeClass('collapsed');
                    $this.closest(".nav.false.collapse").addClass('show');
                    $this.addClass('active');
                }
            })
        })

        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }

    </script>
</body>

</html>