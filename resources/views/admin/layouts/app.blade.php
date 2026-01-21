<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - EMX Auto Repair')</title>
    @if(isset($settings['favicon']) && $settings['favicon'])
        <link rel="icon" href="{{ asset('uploads/gallery/' . $settings['favicon']) }}" type="image/x-icon">
    @endif

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-pages.css') }}">

    <!-- Fonts & Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    @yield('styles')
</head>

<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <span class="accent">EMX</span> Admin
            </div>
        </div>

        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.site-settings') }}"
                class="nav-item {{ request()->routeIs('admin.site-settings') ? 'active' : '' }}">
                <i class="fas fa-cogs"></i>
                <span>Site Settings</span>
            </a>
            <a href="{{ route('admin.gallery') }}"
                class="nav-item {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                <i class="fas fa-images"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ route('admin.services') }}"
                class="nav-item {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                <i class="fas fa-wrench"></i>
                <span>Services</span>
            </a>
            <a href="{{ route('admin.pages') }}"
                class="nav-item {{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Pages</span>
            </a>
            <a href="{{ route('admin.users') }}"
                class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.reviews') }}"
                class="nav-item {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                <i class="fas fa-star"></i>
                <span>Reviews</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('admin.account') }}"
                class="nav-item {{ request()->routeIs('admin.account') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                <span>My Account</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <button id="sidebar-toggle" class="btn-icon">
                <i class="fas fa-bars"></i>
            </button>

            <div class="header-right">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-text">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
                <button id="logout-btn" class="btn btn-outline-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Global AJAX Setup for CSRF
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('assets/admin/js/admin-sidebar.js') }}"></script>
    @yield('scripts')
</body>

</html>