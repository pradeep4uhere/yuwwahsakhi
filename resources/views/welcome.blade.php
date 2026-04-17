<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YuWaah Sakhi</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="fast2sms" content="s2p0Ya8eRcLPPJV4vw5tVm1IlkP1e90N">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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

        .yuwaah-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .yuwaah-mobile-card {
            width: 100%;
            max-width: 430px;
            min-height: calc(100vh - 32px);
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 20px 50px rgba(40, 56, 143, 0.12);
            border-radius: 28px;
            overflow: hidden;
            position: relative;
        }

        .yuwaah-top-glow {
            position: absolute;
            inset: 0 0 auto 0;
            height: 180px;
            background: linear-gradient(180deg, rgba(40, 56, 143, 0.12), rgba(40, 56, 143, 0));
            pointer-events: none;
        }

        .yuwaah-inner {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            min-height: calc(100vh - 32px);
            padding: 28px 20px 24px;
        }

        .yuwaah-logo-wrap {
            display: flex;
            justify-content: center;
            margin-top: 6px;
            margin-bottom: 14px;
        }

        .yuwaah-logo {
            width: 94px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 18px rgba(40, 56, 143, 0.12));
        }

        .yuwaah-badge {
            margin: 0 auto 16px;
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

        .yuwaah-title {
            text-align: center;
            font-size: 20px;
            line-height: 1.35;
            font-weight: 800;
            color: #111827;
            margin-bottom: 14px;
        }

        .yuwaah-content-box {
            background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(248,250,252,0.95));
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            padding: 18px 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }

        .yuwaah-description {
            font-size: 13px;
            line-height: 1.75;
            color: #374151;
        }

        .yuwaah-description p {
            margin-bottom: 10px;
        }

        .yuwaah-description p:last-child {
            margin-bottom: 0;
        }

        .yuwaah-spacer {
            flex: 1;
            min-height: 24px;
        }

        .yuwaah-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #28388F 0%, #4256d0 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 14px 26px rgba(40, 56, 143, 0.22);
            transition: all 0.25s ease;
        }

        .yuwaah-btn:hover {
            transform: translateY(-1px);
            color: #fff;
        }

        .yuwaah-footer-links {
            margin-top: 16px;
            text-align: center;
        }

        .yuwaah-footer-links a {
            color: #28388F;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .yuwaah-footer-links a:hover {
            text-decoration: underline;
        }

        .yuwaah-logout-text {
            font-size: 13px;
            color: #4b5563;
        }

        @media (max-width: 480px) {
            .yuwaah-shell {
                padding: 0;
            }

            .yuwaah-mobile-card {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
            }

            .yuwaah-inner {
                min-height: 100vh;
                padding: 24px 16px 20px;
            }

            .yuwaah-title {
                font-size: 18px;
            }

            .yuwaah-description {
                font-size: 12.5px;
            }
        }
    </style>
</head>

<body>
    <div class="yuwaah-shell">
        <div id="screen1" class="yuwaah-mobile-card">
            <div class="yuwaah-top-glow"></div>

            <div class="yuwaah-inner">
                <div class="yuwaah-logo-wrap">
                    <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo" class="yuwaah-logo">
                </div>

                <div class="text-center">
                    <div class="yuwaah-badge">
                        <i class="fas fa-star text-[10px]"></i>
                        YuWaah Sakhi Platform
                    </div>
                </div>

                <h2 class="yuwaah-title">
                    {{ $YuwaahSakhiSetting['home_page_title'] }}
                </h2>

                <div class="yuwaah-content-box">
                    <div class="yuwaah-description prose prose-sm max-w-none">
                        {!! $YuwaahSakhiSetting['description'] !!}
                    </div>
                </div>

                <div class="yuwaah-spacer"></div>

                <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" class="yuwaah-btn">
                    @if(Auth::check())
                        <span>Go to Home</span>
                    @else
                        <span>Login to Continue</span>
                    @endif
                </a>

                <div class="yuwaah-footer-links">
                    @if(!Auth::check())
                        <p class="mb-0">
                            <a href="{{ route('recoverpassword') }}">
                                Generate New Password
                            </a>
                        </p>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <p class="mb-0 yuwaah-logout-text">
                                This is not you?
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </a>
                            </p>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>