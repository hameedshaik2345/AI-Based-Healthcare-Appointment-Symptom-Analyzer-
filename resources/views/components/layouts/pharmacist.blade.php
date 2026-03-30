<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacist Dashboard - HealthCare Plus</title>
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
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
            padding: 2rem 1.5rem;
            flex-shrink: 0;
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
            font-weight: 600;
            margin-bottom: 1rem;
            background-color: #ffffff;
            border: 2px solid #e1e7ef;
            transition: all 0.3s ease;
        }

        .sidebar-link i {
            font-size: 1.4rem;
        }

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
    </style>
</head>

<body>
    <div class="dashboard-layout">
        <aside class="sidebar">
            <h1 class="h3 fw-bold mb-5 text-center" style="color: #0066CC; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                <i class="bi bi-capsule-pill text-danger"></i><br>Pharmacy<br><span class="text-info">Portal</span>
            </h1>
            <nav>
                <a href="{{ route('pharmacist.dashboard') }}" class="sidebar-link active">
                    <i class="bi bi-receipt"></i> Process Bills
                </a>
                <a href="#" class="sidebar-link" onclick="alert('Module in Development');">
                    <i class="bi bi-box-seam"></i> Inventory
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
                            class="text-danger fw-bold text-decoration-none">Logout</a>
                    </form>
                </div>
            </header>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>