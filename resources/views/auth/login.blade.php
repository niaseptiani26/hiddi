<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | StudioPro Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --accent-color: #d4af37;
            --bg-dark: #0f0f0f;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            /* Background halus bertema fotografi */
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(212, 175, 55, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(212, 175, 55, 0.05) 0%, transparent 40%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 3rem;
            width: 100%;
            max-width: 400px;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo h2 {
            color: #fff;
            letter-spacing: 3px;
            font-weight: 600;
            margin-bottom: 0;
        }

        .brand-logo span {
            color: var(--accent-color);
        }

        .form-label {
            color: #a0a0a0;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.15);
            color: #fff;
        }

        .btn-login {
            background: var(--accent-color);
            border: none;
            color: #000;
            font-weight: 600;
            padding: 0.8rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: #f1c40f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .error-msg {
            background: rgba(220, 53, 69, 0.1);
            color: #ff6b6b;
            padding: 0.7rem;
            border-radius: 8px;
            font-size: 0.85rem;
            text-align: center;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-logo">
        <div class="mb-2">
            <i data-lucide="camera" style="color: var(--accent-color); width: 40px; height: 40px;"></i>
        </div>
        <h2>HIDDI<span>STORY</span></h2>
        <p class="text-muted" style="font-size: 0.75rem;">ADMINISTRATOR PORTAL</p>
    </div>

    @if(session('error'))
        <div class="error-msg">
            <i data-lucide="alert-circle" style="width: 16px; margin-top: -3px;"></i> 
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <label class="form-label text-uppercase">Email Address</label>
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="admin@studiopro.com" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-uppercase">Password</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" style="background-color: transparent; border-color: rgba(255,255,255,0.2);">
                <label class="form-check-label text-muted" for="remember" style="font-size: 0.8rem;">
                    Remember me
                </label>
            </div>
            <a href="#" class="text-decoration-none" style="color: var(--accent-color); font-size: 0.8rem;">Forgot?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">
            Sign In
        </button>
    </form>

    <p class="text-center mt-4 text-muted" style="font-size: 0.7rem;">
        &copy; 2026  HIDDI STORY. All rights reserved.
    </p>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>