<!DOCTYPE html>
<html class="loading @if (setting('theme') == 'dark') dark-layout @endif" lang="{{ session()->get('locale') }}"
    data-layout="dark-layout" data-textdirection="ltr">

<head>
    @include('layouts.partials.metatag')
    <title>Admin {{ setting('name') }} - @yield('title')</title>

    @include('layouts.partials.stylesheet')

    @yield('custom-css')
    @stack('css')
</head>

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <!-- Header -->
    @include('layouts.partials.header')
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header mb-2">
        <ul class="nav navbar-nav flex-row justify-content-between">
        <li class="nav-item me-auto">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <span class="brand-logo">
            <!-- Expanded Logo -->
            <img id="expanded-logo" height="40" width="160" src="{{url('public\images\employee\2024-12-14-675d2b01a652e.png') }}" alt="Expanded Logo" style="display: block;"/>
            <!-- Collapsed Logo -->
            <img id="collapsed-logo" height="40" width="40" src="{{url('public\images\employee\AL-modiana.png') }}" alt="Collapsed Logo" style="display: none;"/>
        </span>
        <h4 class="brand-text">{{ setting('name') }}</h4>
    </a>
</li>

<li class="nav-item nav-toggle">
    <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
    </a>
</li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        @include('layouts.partials.sidebar')
    </div>
</div>
    <!-- End Sidebar -->


    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
                <!-- @include('layouts.partials.footer') -->
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

    @include('layouts.partials.script')

    @yield('custom-js')
    @stack('js')

    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainMenu = document.querySelector('.main-menu');
        const expandedLogo = document.getElementById('expanded-logo');
        const collapsedLogo = document.getElementById('collapsed-logo');

        // Show expanded logo on hover and collapsed logo on leave
        mainMenu.addEventListener('mouseenter', function () {
            if (document.body.classList.contains('menu-collapsed')) {
                expandedLogo.style.display = 'block';
                collapsedLogo.style.display = 'none';
            }
        });

        mainMenu.addEventListener('mouseleave', function () {
            if (document.body.classList.contains('menu-collapsed')) {
                expandedLogo.style.display = 'none';
                collapsedLogo.style.display = 'block';
            }
        });

        // Load initial state from localStorage
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
            document.body.classList.add('menu-collapsed');
            expandedLogo.style.display = 'none';
            collapsedLogo.style.display = 'block';
        }

        // Toggle the sidebar state when clicking the toggle button
        const toggleButton = document.querySelector('.nav-link.modern-nav-toggle');
        toggleButton.addEventListener('click', function () {
            const sidebarCollapsed = document.body.classList.toggle('menu-collapsed');
            localStorage.setItem('sidebar-collapsed', sidebarCollapsed);

            if (sidebarCollapsed) {
                expandedLogo.style.display = 'none';
                collapsedLogo.style.display = 'block';
            } else {
                expandedLogo.style.display = 'block';
                collapsedLogo.style.display = 'none';
            }
        });
    });
</script>

    {!! Toastr::message() !!}

</body>

</html>
