<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Magang Diskominfo</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #4cc9f0;
            --danger: #dc3545;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        /* Animated Background */
        .bg-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, rgba(102, 126, 234, 0) 70%);
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 200px;
            height: 200px;
            top: -50px;
            left: -50px;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            bottom: -50px;
            right: -50px;
            animation-delay: 5s;
        }

        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 50%;
            left: 50%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(15px, 15px) rotate(90deg);
            }
            50% {
                transform: translate(0, 30px) rotate(180deg);
            }
            75% {
                transform: translate(-15px, 15px) rotate(270deg);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            max-width: 380px;
            width: 100%;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .login-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--success);
            filter: drop-shadow(0 3px 8px rgba(76, 201, 240, 0.3));
        }

        .login-header h1 {
            font-size: 1.3rem;
            margin-bottom: 0.2rem;
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            opacity: 0.95;
            font-size: 0.8rem;
            position: relative;
            z-index: 1;
        }

        .login-body {
            padding: 1.5rem 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #333;
            font-size: 0.85rem;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 0.9rem;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.9rem 0.75rem 2.5rem;
            border: 1.5px solid rgba(102, 126, 234, 0.2);
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
        }

        .is-invalid {
            border-color: var(--danger);
        }

        .invalid-feedback {
            color: var(--danger);
            font-size: 0.75rem;
            margin-top: 0.2rem;
            display: block;
            padding-left: 0.5rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 0.8rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.08);
            color: var(--danger);
            border-left: 3px solid var(--danger);
        }

        .login-footer {
            text-align: center;
            padding: 1rem 1.5rem;
            background: rgba(102, 126, 234, 0.03);
            color: #6c757d;
            font-size: 0.75rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #6c757d;
            margin: 1rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(102, 126, 234, 0.15);
        }

        .divider span {
            padding: 0 0.6rem;
            font-size: 0.75rem;
        }

        /* Responsive untuk layar sangat kecil */
        @media (max-width: 360px) {
            body {
                padding: 10px;
            }
            
            .login-container {
                border-radius: 15px;
                max-width: 340px;
            }
            
            .login-header {
                padding: 1.25rem 1rem;
            }
            
            .login-icon {
                font-size: 1.8rem;
            }
            
            .login-header h1 {
                font-size: 1.2rem;
            }
            
            .login-body {
                padding: 1.25rem 1rem;
            }
            
            .login-footer {
                padding: 0.8rem 1rem;
            }
            
            .form-control {
                padding: 0.7rem 0.8rem 0.7rem 2.3rem;
            }
            
            .btn-login {
                padding: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="login-icon">
                <i class="fas fa-city"></i>
            </div>
            <h1>Sistem Magang</h1>
            <p>Diskominfosantik Kota Samarinda</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input 
                            type="email" 
                            id="email"
                            name="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            value="{{ old('email') }}"
                            placeholder="admin@diskominfo.com"
                            required
                            autofocus
                        >
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            id="password"
                            name="password" 
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••"
                            required
                        >
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login Sekarang</span>
                </button>
            </form>

            <div class="divider">
                <span>atau</span>
            </div>

            <div style="text-align: center;">
                <a href="/" style="color: var(--primary); text-decoration: none; font-weight: 500; font-size: 0.85rem;">
                    <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>

        <div class="login-footer">
            <p>&copy; 2024 Diskominfosantik Kota Samarinda</p>
            <p style="margin-top: 0.2rem; font-size: 0.7rem;">Sistem Manajemen Magang v1.0</p>
        </div>
    </div>

    <script>
        // Add subtle animation on input focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
                this.parentElement.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>