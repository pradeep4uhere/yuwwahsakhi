<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YuWaah Sakhi - Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- for date -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <script src="index.js" defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background:
                radial-gradient(circle at top, rgba(40, 56, 143, 0.18), transparent 35%),
                linear-gradient(180deg, #eef2ff 0%, #f8fafc 45%, #ffffff 100%);
            min-height: 100vh;
        }

        .yuwaah-auth-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .yuwaah-auth-card {
            width: 100%;
            max-width: 430px;
            min-height: calc(100vh - 32px);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.75);
            box-shadow: 0 20px 50px rgba(40, 56, 143, 0.12);
            border-radius: 28px;
            overflow: hidden;
            position: relative;
        }

        .yuwaah-auth-glow {
            position: absolute;
            inset: 0 0 auto 0;
            height: 180px;
            background: linear-gradient(180deg, rgba(40, 56, 143, 0.12), rgba(40, 56, 143, 0));
            pointer-events: none;
        }

        .yuwaah-auth-inner {
            position: relative;
            z-index: 2;
            min-height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
            padding: 24px 20px 24px;
        }

        .yuwaah-back-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(40, 56, 143, 0.08);
            border: 1px solid rgba(40, 56, 143, 0.08);
            transition: all 0.25s ease;
        }

        .yuwaah-back-btn:hover {
            background: rgba(40, 56, 143, 0.14);
        }

        .yuwaah-back-btn img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        .yuwaah-auth-logo-wrap {
            display: flex;
            justify-content: center;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        .yuwaah-auth-logo {
            width: 92px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 18px rgba(40, 56, 143, 0.12));
        }

        .yuwaah-auth-badge {
            margin: 0 auto 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(40, 56, 143, 0.08);
            color: #28388F;
            border: 1px solid rgba(40, 56, 143, 0.08);
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .yuwaah-auth-title {
            font-size: 28px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 6px;
            text-align: center;
        }

        .yuwaah-auth-subtitle {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 22px;
        }

        .yuwaah-alert-success {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .yuwaah-form-box {
            background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(248,250,252,0.96));
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            padding: 18px 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }

        .yuwaah-form-group {
            margin-bottom: 16px;
        }

        .yuwaah-form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .yuwaah-input-wrap {
            position: relative;
        }

        .yuwaah-input {
            width: 100%;
            min-height: 48px;
            border-radius: 14px;
            border: 1px solid #dbe3f0;
            background: #ffffff;
            padding: 12px 14px;
            font-size: 14px;
            color: #111827;
            outline: none;
            transition: all 0.25s ease;
        }

        .yuwaah-input::placeholder {
            color: #9ca3af;
            font-size: 12px;
        }

        .yuwaah-input:focus {
            border-color: #4256d0;
            box-shadow: 0 0 0 4px rgba(66, 86, 208, 0.08);
        }

        .yuwaah-password-input {
            padding-right: 48px;
        }

        .yuwaah-toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #05A7D1;
            font-size: 15px;
            cursor: pointer;
        }

        .yuwaah-forgot-row {
            text-align: right;
            margin-top: -2px;
            margin-bottom: 18px;
        }

        .yuwaah-forgot-link {
            font-size: 12px;
            font-weight: 700;
            color: #05A7D1;
            text-decoration: none;
        }

        .yuwaah-forgot-link:hover {
            text-decoration: underline;
        }

        .yuwaah-login-btn {
            width: 100%;
            min-height: 52px;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #28388F 0%, #4256d0 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            box-shadow: 0 14px 26px rgba(40, 56, 143, 0.22);
            transition: all 0.25s ease;
        }

        .yuwaah-login-btn:hover {
            transform: translateY(-1px);
        }

        .yuwaah-auth-footer {
            margin-top: auto;
            padding-top: 18px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        .yuwaah-auth-footer a {
            color: #28388F;
            font-weight: 700;
            text-decoration: none;
        }

        .yuwaah-auth-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .yuwaah-auth-shell {
                padding: 0;
            }

            .yuwaah-auth-card {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
            }

            .yuwaah-auth-inner {
                min-height: 100vh;
                padding: 20px 16px;
            }

            .yuwaah-auth-title {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="yuwaah-auth-shell">
        <div id="screen4" class="yuwaah-auth-card">
            <div class="yuwaah-auth-glow"></div>

            <div class="yuwaah-auth-inner">
                <div class="mb-4">
                    <a href="{{ route('welcome') }}" class="yuwaah-back-btn">
                        <img src="{{ asset('asset/images/arrow-left.png') }}" alt="Back">
                    </a>
                </div>

                <div class="yuwaah-auth-logo-wrap">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo" class="yuwaah-auth-logo">
                    </a>
                </div>

                <div class="text-center">
                    <div class="yuwaah-auth-badge">
                        <i class="fas fa-lock text-[10px]"></i>
                        Secure Login
                    </div>
                </div>

                <h1 class="yuwaah-auth-title">Login</h1>
                <p class="yuwaah-auth-subtitle">Access your Field Agent account securely</p>

                @if (session('success.rsuccess'))
                    <div class="yuwaah-alert-success">
                        {{ session('success.rsuccess') }}
                    </div>
                @endif

                <div class="yuwaah-form-box">
                    <form class="space-y-0" action="{{ route('user.login') }}" method="post">
                        @csrf

                        <div class="yuwaah-form-group">
                            <label for="username" class="yuwaah-form-label">Field Agent ID</label>
                            <div class="yuwaah-input-wrap">
                                <input
                                    id="username"
                                    type="text"
                                    placeholder="Enter Field Agent ID"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="yuwaah-input"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="yuwaah-form-group">
                            <label for="password" class="yuwaah-form-label">Password</label>
                            <div class="yuwaah-input-wrap">
                                <input
                                    id="password"
                                    type="password"
                                    placeholder="Enter Password"
                                    name="password"
                                    class="yuwaah-input yuwaah-password-input"
                                >
                                <button type="button" id="togglePassword" class="yuwaah-toggle-password">
                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="yuwaah-forgot-row">
                            <a href="{{ route('recoverpassword') }}" class="yuwaah-forgot-link">
                                Forgot Password / Generate Password
                            </a>
                        </div>

                        <button type="submit" class="yuwaah-login-btn">
                            Login
                        </button>
                    </form>
                </div>

                <div class="yuwaah-auth-footer">
                    Need help accessing your account?
                    <a href="{{ route('recoverpassword') }}">Recover Password</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>