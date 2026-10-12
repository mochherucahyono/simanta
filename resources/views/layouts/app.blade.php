<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Tanah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --claude-bg: #faf9f5;
            --claude-surface: #ffffff;
            --claude-text: #3d3929;
            --claude-text-light: #706b5b;
            --claude-border: #e6e4dc;
            --claude-hover: #f3f1e5;
            --claude-brand: #0f766e;
            --claude-brand-light: #f0fdfa;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-soft: 0 4px 20px rgba(61, 57, 41, 0.04);
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--claude-bg);
            color: var(--claude-text);
            min-height: 100vh;
        }

        /* ===== Navbar Style Claude ===== */
        .navbar {
            background: var(--claude-surface);
            border-bottom: 1px solid var(--claude-border);
            padding: 0.75rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .navbar-brand img {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.08));
            transition: transform 0.25s ease;
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .navbar-brand span {
            color: var(--claude-text);
            font-size: 1.05rem;
            letter-spacing: -0.01em;
        }

        .navbar .nav-link {
            color: var(--claude-text-light) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.5rem 0.875rem !important;
            border-radius: var(--radius-md);
            margin: 0 0.15rem;
            transition: all 0.2s ease;
        }

        .navbar .nav-link:hover {
            color: var(--claude-text) !important;
            background: var(--claude-hover);
        }

        .navbar .nav-link.active {
            color: var(--claude-brand) !important;
            background: var(--claude-brand-light);
            font-weight: 600;
        }

        .navbar-toggler {
            border: 1px solid var(--claude-border);
            box-shadow: none !important;
            padding: 0.4rem 0.6rem;
        }

        /* ===== Main content wrapper ===== */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.25rem 2.5rem;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Card & Table Styling ===== */
        .card {
            border: 1px solid var(--claude-border);
            border-radius: var(--radius-lg);
            background: var(--claude-surface);
            box-shadow: var(--shadow-soft);
        }

        .table thead th {
            background: #f7f6f0;
            color: var(--claude-text);
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-bottom: 1px solid var(--claude-border);
        }

        .table tbody tr:hover {
            background: var(--claude-hover);
        }

        .btn-primary {
            background: var(--claude-brand);
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 0.55rem 1.25rem;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(15, 118, 110, 0.2);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #0d655e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
        }

        /* ===== Footer ===== */
        .footer {
            padding: 1.25rem 0;
            color: var(--claude-text-light);
            font-size: 0.82rem;
            border-top: 1px solid var(--claude-border);
            background: var(--claude-surface);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/tanahs') }}">
                <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Logo" width="32" height="32"
                    class="me-2">
                <span class="d-none d-sm-inline">Sistem Manajemen Tanah</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('tanahs') ? ' active' : '' }}" href="{{ url('/tanahs') }}">
                            <span class="material-symbols-outlined align-middle me-1">map</span>Tanah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('sertifikats') ? ' active' : '' }}"
                            href="{{ route('sertifikats.index') }}">
                            <span class="material-symbols-outlined align-middle me-1">description</span>Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('tanahs/jenis_tanah') ? ' active' : '' }}"
                            href="{{ route('jenis.tampil_jenis_tanah') }}">
                            <span class="material-symbols-outlined align-middle me-1">category</span>Jenis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('tanahs/desa_tanah') ? ' active' : '' }}"
                            href="{{ route('desa.tampil_desa_tanah') }}">
                            <span class="material-symbols-outlined align-middle me-1">location_city</span>Desa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ request()->is('tanahs/nadzir_tanah') ? ' active' : '' }}"
                            href="{{ route('nadzir.tampil_nadzir_tanah') }}">
                            <span class="material-symbols-outlined align-middle me-1">groups</span>Nadzir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="mt-4">
        @yield('content')
    </main>
    <footer class="footer mt-5 text-center">
        <p class="mb-0">Copyright &copy; 2025 Sistem Manajemen Tanah. All rights reserved. Made by Heru Cahyono</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>