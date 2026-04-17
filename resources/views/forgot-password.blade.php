<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouthHub Partner - Reset Password</title>

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

        .yh-auth-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .yh-auth-card {
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

        .yh-auth-glow {
            position: absolute;
            inset: 0 0 auto 0;
            height: 180px;
            background: linear-gradient(180deg, rgba(40, 56, 143, 0.12), rgba(40, 56, 143, 0));
            pointer-events: none;
        }

        .yh-auth-inner {
            position: relative;
            z-index: 2;
            min-height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
            padding: 24px 20px 24px;
        }

        .yh-back-btn {
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

        .yh-back-btn:hover {
            background: rgba(40, 56, 143, 0.14);
        }

        .yh-back-btn img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        .yh-auth-logo-wrap {
            display: flex;
            justify-content: center;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        .yh-auth-logo {
            width: 92px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 18px rgba(40, 56, 143, 0.12));
        }

        .yh-auth-badge {
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

        .yh-auth-title {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 6px;
            text-align: center;
            line-height: 1.3;
        }

        .yh-auth-subtitle {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 22px;
            line-height: 1.7;
        }

        .yh-alert-error {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .yh-alert-error ul {
            margin: 0;
            padding-left: 18px;
        }

        .yh-form-box {
            background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(248,250,252,0.96));
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            padding: 18px 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }

        .yh-form-group {
            margin-bottom: 18px;
        }

        .yh-form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .yh-input {
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
            -moz-appearance: textfield;
        }

        .yh-input::-webkit-outer-spin-button,
        .yh-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .yh-input::placeholder {
            color: #9ca3af;
            font-size: 12px;
        }

        .yh-input:focus {
            border-color: #4256d0;
            box-shadow: 0 0 0 4px rgba(66, 86, 208, 0.08);
        }

        .yh-submit-btn {
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

        .yh-submit-btn:hover {
            transform: translateY(-1px);
        }

        .yh-auth-footer {
            margin-top: auto;
            padding-top: 18px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }

        .yh-auth-footer a {
            color: #05A7D1;
            font-weight: 700;
            text-decoration: none;
        }

        .yh-auth-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .yh-auth-shell {
                padding: 0;
            }

            .yh-auth-card {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
            }

            .yh-auth-inner {
                min-height: 100vh;
                padding: 20px 16px;
            }

            .yh-auth-title {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
    <div class="yh-auth-shell">
        <div id="screen5" class="yh-auth-card">
            <div class="yh-auth-glow"></div>

            <div class="yh-auth-inner">
                <div class="mb-4">
                    <a href="{{ route('login') }}" class="yh-back-btn">
                        <img src="{{ asset('asset/images/arrow-left.png') }}" alt="Back">
                    </a>
                </div>

                <div class="yh-auth-logo-wrap">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo" class="yh-auth-logo">
                    </a>
                </div>

                <div class="text-center">
                    <div class="yh-auth-badge">
                        <i class="fas fa-mobile-alt text-[10px]"></i>
                        Password Recovery
                    </div>
                </div>

                <h1 class="yh-auth-title">Reset / Forgot Password</h1>
                <p class="yh-auth-subtitle">
                    Enter your registered mobile number to verify your account and continue the password recovery process.
                </p>

                @if ($errors->any())
                    <div class="yh-alert-error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="yh-form-box">
                    <form class="space-y-0" action="{{ route('verifymobile') }}" method="post">
                        @csrf

                        <div class="yh-form-group">
                            <label for="mobilenumber" class="yh-form-label">Mobile Number</label>
                            <input
                                id="mobilenumber"
                                name="mobilenumber"
                                type="tel"
                                inputmode="numeric"
                                placeholder="Enter Mobile Number"
                                value="{{ old('mobilenumber') }}"
                                class="yh-input"
                            >
                        </div>

                        <button type="submit" class="yh-submit-btn">
                            Verify Mobile Number
                        </button>
                    </form>
                </div>

                <div class="yh-auth-footer">
                    Already a member?
                    <a href="{{ route('login') }}">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>