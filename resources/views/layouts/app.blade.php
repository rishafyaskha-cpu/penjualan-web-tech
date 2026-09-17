<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Penjualan') - Toko RPL Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6fb; }
        .navbar-brand-custom {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border-radius: .75rem;
            padding: .5rem .9rem;
            color: #fff !important;
            font-weight: 700;
        }
        .navbar-custom { box-shadow: 0 .25rem .75rem rgba(0,0,0,.08); }
        .card { border: 0; border-radius: .9rem; box-shadow: 0 .3rem 1rem rgba(30,41,83,.08); }
        .btn { border-radius: .55rem; }
        footer a { color: #cfe3ff; text-decoration: none; }
        footer a:hover { color: #fff; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-custom">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom" href="{{ route('dashboard') }}">
            <i class="bi bi-shop"></i> Toko RPL Jaya
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}" href="{{ route('barang.index') }}"><i class="bi bi-box-seam"></i> Barang</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}" href="{{ route('transaksi.index') }}"><i class="bi bi-receipt"></i> Transaksi</a></li>
                <li class="nav-item ms-lg-2">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm text-danger fw-semibold"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1 py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="bg-dark text-white-50 py-4 mt-auto">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div>
            <i class="bi bi-shop text-primary"></i> <strong class="text-white">Toko RPL Jaya</strong> &copy; {{ date('Y') }} Aplikasi Penjualan LKS Web Tech
        </div>
        <div class="fw-bold text-white-50">
            &copy; <a href="#" class="text-white fw-bold text-decoration-none">rishafy_studios</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>