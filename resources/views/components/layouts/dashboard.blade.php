<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthCare Plus</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
        }

        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 290px;
            background: linear-gradient(135deg, #ffffff, #fdfdfd);
            border-right: none;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
            padding: 2rem 1.5rem;
            flex-shrink: 0;
            z-index: 10;
        }

        .main-content {
            flex-grow: 1;
            padding: 2.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            text-decoration: none;
            color: #4b5563;
            font-size: 1.15rem;
            /* Increased font size */
            font-weight: 600;
            margin-bottom: 1rem;
            background-color: #ffffff;
            border: 2px solid #e1e7ef;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
        }

        .sidebar-link i {
            font-size: 1.4rem;
        }

        /* Colorful Hover and Active States */
        .sidebar-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.08);
            border-color: #0066CC;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #0066CC, #00B4A6);
            color: white;
            border-color: transparent;
            box-shadow: 0 10px 20px rgba(0, 180, 166, 0.3);
        }

        .card {
            background-color: white;
            padding: 1.75rem;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h1 class="h3 fw-bold mb-5 text-center" style="color: #0066CC; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                <i class="bi bi-heart-pulse-fill text-danger"></i><br>HealthCare<br><span class="text-info">Plus</span>
            </h1>
            <nav>
                <a href="{{ route('patient.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
                <a href="{{ route('patient.appointments.index') }}"
                    class="sidebar-link {{ request()->routeIs('patient.appointments.*') && !request()->routeIs('patient.appointments.history') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-week"></i> Manage
                </a>
                <a href="{{ route('patient.book.create.step.one') }}"
                    class="sidebar-link {{ request()->routeIs('patient.book.*') ? 'active' : '' }}"
                    style="border-color: #10b981;">
                    <i class="bi bi-plus-circle-fill text-success"
                        style="{{ request()->routeIs('patient.book.*') ? 'color: white!important;' : '' }}"></i> Book
                    Visit
                </a>
                <a href="{{ route('patient.appointments.history') }}"
                    class="sidebar-link {{ request()->routeIs('patient.appointments.history') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i> History
                </a>
                <a href="{{ route('patient.profile.edit') }}"
                    class="sidebar-link {{ request()->routeIs('patient.profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Profile
                </a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('homepage') }}" class="text-muted text-decoration-none">← Back to Home</a>
                <div>
                    <span>Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline ms-3">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-danger fw-bold text-decoration-none">
                            Logout
                        </a>
                    </form>
                </div>
            </header>

            {{ $slot }}

        </main>
    </div>
    @stack('scripts')
</body>

</html>