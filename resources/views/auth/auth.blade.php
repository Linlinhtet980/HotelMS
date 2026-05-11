@extends('authlayout.authlayout')

@section('title', 'Authentication')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/split_auth.css') }}">
@endpush

@section('content')
<div class="split-layout">
    
    <!-- Left Side: Image Showcase -->
    <div class="image-side">
        <div class="image-overlay"></div>
        <div class="image-content">
            <span class="glass-badge">Premium Access</span>
            <h2>Welcome to HotelMS</h2>
            <p>Experience the ultimate property management system designed for luxury hotels and resorts. Manage bookings, rooms, and guest experiences seamlessly.</p>
        </div>
    </div>

    <!-- Right Side: Sliding Forms -->
    <div class="form-side">
        <!-- Ambient Glows -->
        <div class="glow-1"></div>
        <div class="glow-2"></div>

        <div class="slider-container {{ isset($mode) && $mode === 'register' ? 'show-register' : '' }}" id="sliderContainer">
            <div class="slider-track">
                
                <!-- Login Panel -->
                <div class="form-panel" id="loginPanel">
                    <div class="auth-card">
                        <div class="brand">
                            <div class="brand-icon">
                                <i class="fa-solid fa-hotel"></i>
                            </div>
                            <h1>Sign In</h1>
                            <p>Access your admin dashboard</p>
                        </div>

                        @if ($errors->any() && (isset($mode) && $mode !== 'register'))
                            <div class="alert-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        @endif

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-envelope icon-left"></i>
                                    <input type="email" name="email" placeholder="admin@hotelms.com" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-lock icon-left"></i>
                                    <input type="password" name="password" id="loginPassword" placeholder="••••••••" required>
                                    <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePass('loginPassword', this)"></i>
                                </div>
                            </div>

                            <div class="form-options">
                                <label class="remember-me">
                                    <input type="checkbox" name="remember">
                                    <span>Remember me</span>
                                </label>
                                <a href="#" class="forgot-link">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn-submit">
                                Sign In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                            </button>

                            <div class="toggle-form">
                                Don't have an account? 
                                <button type="button" class="toggle-btn" id="showRegisterBtn">Create one here</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Register Panel -->
                <div class="form-panel" id="registerPanel">
                    <div class="auth-card">
                        <div class="brand">
                            <div class="brand-icon">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <h1>Register</h1>
                            <p>Create a new admin account</p>
                        </div>

                        @if ($errors->any() && (isset($mode) && $mode === 'register'))
                            <div class="alert-error">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>{{ $errors->first() }}</span>
                            </div>
                        @endif

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-user icon-left"></i>
                                    <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-envelope icon-left"></i>
                                    <input type="email" name="email" placeholder="admin@hotelms.com" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-lock icon-left"></i>
                                    <input type="password" name="password" id="regPassword" placeholder="••••••••" required>
                                    <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePass('regPassword', this)"></i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-shield-check icon-left"></i>
                                    <input type="password" name="password_confirmation" id="regConfirmPassword" placeholder="••••••••" required>
                                    <i class="fa-solid fa-eye-slash toggle-password" onclick="togglePass('regConfirmPassword', this)"></i>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                Create Account <i class="fa-solid fa-arrow-right"></i>
                            </button>

                            <div class="toggle-form">
                                Already have an account? 
                                <button type="button" class="toggle-btn" id="showLoginBtn">Sign in here</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sliderContainer = document.getElementById('sliderContainer');
        const showRegisterBtn = document.getElementById('showRegisterBtn');
        const showLoginBtn = document.getElementById('showLoginBtn');

        // Toggle to Register
        if (showRegisterBtn) {
            showRegisterBtn.addEventListener('click', function() {
                sliderContainer.classList.add('show-register');
                // Optional: Update URL without reloading
                window.history.pushState({}, '', '/register');
            });
        }

        // Toggle to Login
        if (showLoginBtn) {
            showLoginBtn.addEventListener('click', function() {
                sliderContainer.classList.remove('show-register');
                // Optional: Update URL without reloading
                window.history.pushState({}, '', '/login');
            });
        }
    });

    // Toggle Password Visibility
    window.togglePass = function(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            iconElement.classList.toggle('fa-eye');
            iconElement.classList.toggle('fa-eye-slash');
        }
    };
</script>
@endpush
