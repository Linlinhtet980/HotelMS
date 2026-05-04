<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Hotel Management</title>
    <!-- Google Fonts: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/layout/admin.css') }}">
    @stack('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-hotel"></i>
                </div>
                <div class="brand-text">HotelMS</div>
            </div>

            <nav class="nav-links">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('rooms.index') }}" class="nav-item {{ request()->is('rooms*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bed"></i>
                    <span>Rooms</span>
                </a>

                <a href="{{ route('bookings.index') }}" class="nav-item {{ request()->is('bookings*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>

                <a href="{{ route('Amenities.index') }}" class="nav-item {{ request()->routeIs('Amenities.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                    <span>Amenities</span>
                </a>

                <a href="#" class="nav-item">
                    <i class="fa-solid fa-gear"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Topbar -->
            <header class="topbar">
                <div class="topbar-left">
                    <div class="breadcrumb">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </div>
                </div>

                <div class="topbar-center">
                    <!-- Search box removed -->
                </div>

                <div class="topbar-right">
                    <div class="user-avatar">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=7C3AED&color=fff" alt="User">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                <div class="content-header">
                    <h1 class="page-title">Overview</h1>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
