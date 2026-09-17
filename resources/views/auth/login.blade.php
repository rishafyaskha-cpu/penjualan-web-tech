<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko RPL Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }
        .login-card { border-radius: 1rem; box-shadow: 0 1rem 2rem rgba(0,0,0,.25); }
        .brand-badge {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
            border-radius: 50%;
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 1.8rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<div class="flex-grow-1 d-flex align-items-center justify-content-center p-3">
    <div class="card login-card border-0" style="width: 400px;">
        <div class="card-body p-4">
            <div class="brand-badge mb-3"><i class="bi bi-shop"></i></div>
            <h4 class="text-center fw-bold mb-1">Toko RPL Jaya</h4>
            <p class="text-center text-muted mb-4">Silakan masuk untuk melanjutkan</p>

            @if($errors->any())
                <div class="alert alert-danger py-2 d-flex align-items-center">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small text-muted">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="admin@gmail.com" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="*****" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2"><i class="bi bi-box-arrow-in-right me-1"></i> Login</button>
            </form>
        </div>
    </div>
</div>
<footer class="text-center text-white-50 small py-3">
    <span class="fw-bold text-white">rishafy_studios</span> &copy; {{ date('Y') }}
</footer>
</body>
</html>