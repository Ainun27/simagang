<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* =============== RESET & BASE =============== */
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #ffc107;
            --danger: #dc3545;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --card-bg: rgba(255, 255, 255, 0.97);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
            --shadow-md: 0 8px 30px rgba(0,0,0,0.12);
            --shadow-lg: 0 15px 40px rgba(0,0,0,0.15);
            --border-radius: 12px;
            --border-radius-lg: 18px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            color: var(--light);
            overflow-x: hidden;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* =============== TYPOGRAPHY =============== */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        h1 { font-size: 2.25rem; }
        h2 { font-size: 1.875rem; }
        h3 { font-size: 1.5rem; }
        h4 { font-size: 1.25rem; }
        h5 { font-size: 1.125rem; }
        h6 { font-size: 1rem; }

        p {
            margin-bottom: 1rem;
        }

        a {
            color: inherit;
            text-decoration: none;
            transition: var(--transition);
        }

        /* =============== BACKGROUND ELEMENTS =============== */
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2; /* Ubah ke -2 untuk lebih aman */
            overflow: hidden;
            opacity: 0.6;
            pointer-events: none; /* Tambahkan ini */
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, rgba(102, 126, 234, 0) 70%);
            filter: blur(20px);
        }

        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
            animation: float 25s infinite linear;
        }

        .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 10%;
            animation: float 20s infinite linear reverse;
        }

        .shape:nth-child(3) {
            width: 150px;
            height: 150px;
            bottom: 20%;
            left: 20%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            100% {
                transform: translate(100px, 100px) rotate(360deg);
            }
        }

        /* =============== NAVBAR =============== */
        .navbar {
            background: rgba(26, 26, 46, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1000;
            min-height: 70px;
        }

        .navbar-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1.5rem;
            height: 70px;
            position: relative;
        }

        /* Brand Logo */
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            background: rgba(255, 255, 255, 0.05);
            transition: var(--transition);
            color: white;
            font-weight: 600;
            font-size: 1.125rem;
            white-space: nowrap;
        }

        .navbar-brand:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .navbar-brand i {
            color: var(--success);
            font-size: 1.25rem;
        }

        /* Mobile Menu Toggle */
        .menu-toggle {
            display: none;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .menu-toggle:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Navigation Menu */
        .navbar-menu {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            font-size: 0.9375rem;
            white-space: nowrap;
            transition: var(--transition);
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.25), rgba(118, 75, 162, 0.25));
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .nav-link i {
            font-size: 1rem;
        }

        /* User Section */
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-left: 2rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.875rem;
        }

        .user-info i {
            color: var(--success);
        }

        .btn-logout {
            background: rgba(220, 53, 69, 0.2);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(220, 53, 69, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .btn-logout:hover {
            background: rgba(220, 53, 69, 0.3);
            border-color: rgba(220, 53, 69, 0.4);
            transform: translateY(-1px);
        }

        /* =============== MAIN CONTAINER =============== */
        .main-container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            position: relative;
        }

        /* =============== CARDS =============== */
        .card {
            background: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .card-title i {
            color: var(--primary);
        }

        .card-body {
            padding: 2rem;
        }

        /* =============== FORMS =============== */
        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9375rem;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--gray-light);
            border-radius: 10px;
            font-size: 0.9375rem;
            transition: var(--transition);
            background: white;
            color: var(--dark);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon .form-control {
            padding-left: 3rem;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1rem;
        }

        /* =============== BUTTONS =============== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9375rem;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        /* =============== TABLES =============== */
        .table-responsive {
            overflow-x: auto;
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            background: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .table thead {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        }

        .table th {
            padding: 1.25rem 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--dark);
            border-bottom: 2px solid rgba(102, 126, 234, 0.2);
            white-space: nowrap;
        }

        .table td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            color: var(--dark);
            vertical-align: middle;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.03);
        }

        /* =============== ALERTS =============== */
        .alert {
            padding: 1.25rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-left: 4px solid;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: rgba(76, 201, 240, 0.1);
            color: var(--success);
            border-left-color: var(--success);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border-left-color: var(--danger);
        }

        .alert i {
            font-size: 1.25rem;
        }

        /* =============== BADGES =============== */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .badge-warning {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning);
        }

        .badge-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger);
        }

        /* =============== UTILITY CLASSES =============== */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-muted { color: var(--gray); }
        .text-white { color: white; }
        .text-dark { color: var(--dark); }

        .d-flex { display: flex; }
        .d-none { display: none; }
        .d-block { display: block; }

        .flex-column { flex-direction: column; }
        .flex-wrap { flex-wrap: wrap; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .align-center { align-items: center; }
        .align-start { align-items: flex-start; }

        .gap-1 { gap: 0.5rem; }
        .gap-2 { gap: 1rem; }
        .gap-3 { gap: 1.5rem; }

        .w-100 { width: 100%; }
        .mw-100 { max-width: 100%; }

        .mt-1 { margin-top: 0.5rem; }
        .mt-2 { margin-top: 1rem; }
        .mt-3 { margin-top: 1.5rem; }
        .mt-4 { margin-top: 2rem; }

        .mb-1 { margin-bottom: 0.5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .mb-3 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 2rem; }

        .mx-auto { margin-left: auto; margin-right: auto; }

        .shadow-sm { box-shadow: var(--shadow-sm); }
        .shadow-md { box-shadow: var(--shadow-md); }
        .shadow-lg { box-shadow: var(--shadow-lg); }

        /* =============== RESPONSIVE BREAKPOINTS =============== */

        /* Large Desktop */
        @media (min-width: 1400px) {
            .main-container {
                padding: 0;
            }
        }

        /* Tablet */
        @media (max-width: 992px) {
            .navbar-menu {
                gap: 0.25rem;
            }
            
            .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
            
            .navbar-user {
                margin-left: 1rem;
            }
            
            .card-header,
            .card-body {
                padding: 1.5rem;
            }
        }

        /* Mobile Landscape */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }
            
            .navbar-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                flex-direction: column;
                background: rgba(26, 26, 46, 0.95);
                backdrop-filter: blur(20px);
                padding: 1rem;
                border-radius: 0 0 12px 12px;
                box-shadow: var(--shadow-lg);
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: var(--transition);
            }
            
            .navbar-menu.active {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            .nav-item {
                width: 100%;
            }
            
            .nav-link {
                padding: 0.875rem 1rem;
                border-radius: 8px;
                justify-content: flex-start;
            }
            
            .navbar-user {
                margin-left: 0;
                flex-direction: column;
                width: 100%;
                gap: 0.75rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .main-container {
                margin: 1.5rem auto;
                padding: 0 1rem;
            }
            
            .card-header,
            .card-body {
                padding: 1.25rem;
            }
            
            h1 { font-size: 1.875rem; }
            h2 { font-size: 1.5rem; }
            h3 { font-size: 1.25rem; }
        }

        /* Mobile Portrait */
        @media (max-width: 576px) {
            .navbar-container {
                padding: 0 1rem;
            }
            
            .navbar-brand {
                font-size: 1rem;
                padding: 0.5rem;
            }
            
            .navbar-brand span {
                display: none;
            }
            
            .main-container {
                margin: 1rem auto;
            }
            
            .card {
                border-radius: 10px;
                margin-bottom: 1rem;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .table td,
            .table th {
                padding: 0.875rem 0.75rem;
                font-size: 0.875rem;
            }
            
            .alert {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
                padding: 1rem;
            }
        }

        /* Extra Small */
        @media (max-width: 400px) {
            .card-header,
            .card-body {
                padding: 1rem;
            }
            
            .form-control {
                font-size: 16px; /* Prevent iOS zoom */
            }
            
            .badge {
                font-size: 0.6875rem;
                padding: 0.25rem 0.5rem;
            }
        }

        /* Print Styles */
        @media print {
            .navbar,
            .btn,
            .menu-toggle {
                display: none !important;
            }
            
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
                break-inside: avoid;
            }
            
            body {
                background: white !important;
                color: black !important;
            }
            
            .main-container {
                margin: 0;
                padding: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <!-- Navbar -->
    @auth
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                <i class="fas fa-city"></i>
                <span>Sistem Magang</span>
            </a>
            
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <ul class="navbar-menu" id="navbarMenu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.divisi.index') }}" class="nav-link {{ request()->routeIs('admin.divisi.*') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Divisi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                
                <!-- User Section in Mobile Menu -->
                <li class="nav-item d-block d-mobile-only">
                    <div class="navbar-user">
                        <div class="user-info">
                            <i class="fas fa-user-circle"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <form action="{{ route('logout') }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn-logout w-100">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
            
            <!-- User Section for Desktop -->
            <div class="navbar-user d-none d-desktop-only">
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="main-container">
        @yield('content')
    </main>

    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menuToggle');
            const navbarMenu = document.getElementById('navbarMenu');
            const html = document.documentElement;
            
            if (menuToggle && navbarMenu) {
                // Toggle menu
                menuToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    navbarMenu.classList.toggle('active');
                    menuToggle.innerHTML = navbarMenu.classList.contains('active') 
                        ? '<i class="fas fa-times"></i>' 
                        : '<i class="fas fa-bars"></i>';
                });
                
                // Close menu when clicking outside
                document.addEventListener('click', function(e) {
                    if (!navbarMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                        navbarMenu.classList.remove('active');
                        menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                });
                
                // Close menu on escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        navbarMenu.classList.remove('active');
                        menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                });
                
                // Close menu on window resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 768) {
                        navbarMenu.classList.remove('active');
                        menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                });
                
                // Close menu when clicking a link (mobile)
                if (window.innerWidth <= 768) {
                    const navLinks = navbarMenu.querySelectorAll('.nav-link');
                    navLinks.forEach(link => {
                        link.addEventListener('click', function() {
                            navbarMenu.classList.remove('active');
                            menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                        });
                    });
                }
            }
            
            // Set active nav link based on current URL
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath === currentPath || 
                    (linkPath !== '/' && currentPath.startsWith(linkPath))) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            // Add smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Prevent body scroll when menu is open
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        if (navbarMenu.classList.contains('active')) {
                            html.style.overflow = 'hidden';
                        } else {
                            html.style.overflow = '';
                        }
                    }
                });
            });
            
            if (navbarMenu) {
                observer.observe(navbarMenu, { attributes: true });
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>