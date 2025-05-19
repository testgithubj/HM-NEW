


<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>

    <meta property="og:image" content="{{ asset('pharmacy-new.jpg') }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Pharmacy Software solution is built to manage overall pharmacy business activities including medicine management, purchase management, supplier or manufacturers management, stock management, sales management, daily or monthly accounts management. Most importantly follow up the low stock medicine manage purchase from manufacturers, manage the customers and manufacturers due payment. This software is easy to use and manage with easy medicine search, easy invoice creation, pharmacy faster daily operation and date wise details report.">
    <meta name="keywords" content="Complete Pharmacy Software Solutions, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name', 'ATL Pharma') }}</title>
    <link rel="apple-touch-icon" href="{{ globalAsset(setting('favicon'), 'settings') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ globalAsset(setting('favicon'), 'settings') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    <style>
        html body p {
            color: #fff !important;
        }

        .dark-layout h2 {
            color: #fff !important;
        }

        .dark-layout label {
            color: #fff !important;
        }

        .dark-layout .input-group .input-group-text {
            background-color: #fff !important;
        }

        .dark-layout .form-check-input:not(:checked) {
            background-color: #fff !important;
        }

        input.form-control {
            color: #000000 !important;
        }

        .dark-layout .btn.btn-dark {
            background-color: #161d31 !important;
        }

        .dark-layout .auth-wrapper .auth-bg {
            background-color: #ff9f43;
        }

        form .error:not(input) {
            color: #ff0002;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo">
                            <img src="{{ globalAsset(setting('favicon'), 'settings') }}" height="24" width="24">
                            <h2 class="brand-text ms-1 text-uppercase" style="color:#ffffff;">
                                {{ config('app.name', 'ATL Pharma') }}</h2>
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5" style="background:#161D31">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                                    class="img-fluid"
                                    src="{{ asset('dashboard/app-assets/images/pages/login-v2-dark.svg') }}"
                                    alt="{{ config('app.name', 'ATL Pharma') }}" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5 ">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <div class="card-header bg-transparent border-0 text-center">
                            <h5>{{ translate('website.Reset Password') }}</h5>
                        </div>
                                <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-label-group mb-3">
                                    <label for="email" class="form-label">{{ translate('website.Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           autocomplete="email" value="{{ $email ?? old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-label-group mb-3">
                                    <label for="password" class="form-label">{{ translate('website.Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-label-group mb-3">
                                    <label for="password_confirmation" class="form-label">{{ translate('website.Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-label-group d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-dark">
                                        {{ translate('website.Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>


                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboard/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('dashboard/app-assets/js/scripts/pages/auth-login.js') }}"></script>
    <!-- END: Page JS-->
    <script type="text/javascript">
        function autoFill() {
            $('#email').val('admin@ayaantec.com');
            $('#password').val('123456');
        }

        function autoFill2() {
            $('#email').val('doctor@gmail.com');
            $('#password').val('12345678');
        }

        function autoFill3() {
            $('#email').val('salem@gmail.com');
            $('#password').val('12345678');
        }
    </script>

</body>
<!-- END: Body-->

</html>
