<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard | Photography Studio</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --sidebar-bg: #1a1a1a;
            --accent-color: #d4af37;
            --text-muted: #a0a0a0;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-bg);
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1040;
        }

        #sidebar.active {
            margin-left: -260px;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-header h5 {
            letter-spacing: 2px;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .nav-link {
            padding: 0.8rem 1.5rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.05);
            border-left: 4px solid var(--accent-color);
        }

        /* ===== CONTENT ===== */
        .main-content {
            margin-left: 260px;
            width: 100%;
            transition: 0.3s;
        }

        .main-content.full {
            margin-left: 0;
        }

        /* ===== NAVBAR ===== */
        .main-navbar {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 1rem 1.5rem;
        }

        /* ===== CONTENT WRAPPER ===== */
        .content-wrapper {
            padding: 2rem;
        }

        /* ===== BUTTON ===== */
        .btn-logout {
            background: transparent;
            border: 1px solid #ff4d4d;
            color: #ff4d4d;
            border-radius: 8px;
            padding: 0.4rem 1.2rem;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #ff4d4d;
            color: #fff;
        }

        /* ===== CARD ===== */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
        }

        /* ===== MOBILE ===== */
        @media (max-width: 992px) {
            #sidebar {
                margin-left: -260px;
            }

            #sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* overlay mobile */
        .overlay {
            display: none;
        }

        .overlay.active {
            display: block;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            z-index: 1030;
        }

    </style>
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div id="sidebar">
        <div class="sidebar-header">
            <h5>HIDDI<span style="color: var(--accent-color)">STORY</span></h5>
            <small class="text-uppercase text-muted" style="font-size: 10px;">Photography Management</small>
        </div>

        <ul class="nav flex-column mt-3">
            <li>
                <a href="/admin/dashboard" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.packages.index') }}" class="nav-link">
                    <i data-lucide="package"></i> Packages
                </a>
            </li>
            <li>
                <a href="{{ route('admin.portfolios.index') }}" class="nav-link">
                    <i data-lucide="camera"></i> Portfolio
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                    <i data-lucide="calendar"></i> Booking
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i data-lucide="credit-card"></i> Categories
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content" id="mainContent">

        {{-- NAVBAR --}}
        <nav class="main-navbar d-flex justify-content-between align-items-center">

            <!-- TOGGLE BUTTON -->
            <button class="btn btn-light d-lg-none" id="toggleSidebar">
                <i data-lucide="menu"></i>
            </button>

            <div>
                <h6 class="mb-0 text-muted">Welcome back,</h6>
                <h5 class="mb-0 fw-bold">{{ auth()->user()->name }}</h5>
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-logout d-flex align-items-center gap-2">
                    <i data-lucide="log-out" style="width:16px"></i> Logout
                </button>
            </form>
        </nav>

        <div class="content-wrapper">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i data-lucide="check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i data-lucide="alert-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{-- CONTENT --}}
            @yield('content')

        </div>

    </div>

</div>

<script>
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');
    const overlay = document.getElementById('overlay');

    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('active');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>