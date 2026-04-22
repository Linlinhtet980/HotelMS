<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Regency Hotel | @yield('title', 'Admin Dashboard')</title>
    <!-- FontAwesome for Premium Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Admin Master Layout CSS -->
    <link rel="stylesheet" href="{{ asset('css/layout/admin.css') }}">
    <!-- Page Specific CSS -->
    @stack('styles')
</head>
<body>

    <div class="admin-container">
        <!-- Vertical Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header" id="sidebarToggle">
                <div class="brand-icon">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <div class="brand-text">
                    Grand<span>Regency</span>
                </div>
            </div>

            <nav class="nav-links">
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('rooms.index') ?? '#' }}" class="nav-item {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bed"></i>
                    <span>Rooms Management</span>
                </a>
                
                <a href="#" class="nav-item">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Bookings</span>
                </a>

                <a href="#" class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Guests</span>
                </a>

                <a href="#" class="nav-item">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Invoices</span>
                </a>

                <div style="margin-top: auto;">
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <main class="main-wrapper">
            <!-- Top Horizontal Bar -->
            <header class="topbar">
                <h1 class="page-title">@yield('page_title', 'Dashboard')</h1>
                
                <div class="topbar-actions">
                    <button class="action-btn">
                        <i class="fa-regular fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    
                    <button class="action-btn">
                        <i class="fa-regular fa-envelope"></i>
                    </button>

                    <div class="profile-menu">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=D4AF37&color=0B0F19" alt="Admin Profile" class="profile-img">
                        <div class="profile-info">
                            <h4>Admin User</h4>
                            <p>General Manager</p>
                        </div>
                        <i class="fa-solid fa-chevron-down" style="color: var(--text-secondary); font-size: 0.8rem; margin-left: 0.5rem;"></i>
                    </div>
                </div>
            </header>

            <!-- Dynamic Content Area -->
            <div class="content-area">
                @if(session('success'))
                    <div class="alert-success" style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid #10B981; color: #10B981; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 2rem; display: flex; align-items: center; gap: 1rem;">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const body = document.body;

            // Load state from localStorage if exists
            if (localStorage.getItem('sidebar-collapsed') === 'true') {
                body.classList.add('sidebar-collapsed');
            }

            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-collapsed');
                
                // Save state so it remembers between page loads
                localStorage.setItem('sidebar-collapsed', body.classList.contains('sidebar-collapsed'));
            });
        });
    </script>
</body>
</html>
