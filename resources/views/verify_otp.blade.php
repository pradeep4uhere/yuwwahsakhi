<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YuWaah Sakhi</title>

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

        .yu-verify-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .yu-verify-card {
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

        .yu-verify-glow {
            position: absolute;
            inset: 0 0 auto 0;
            height: 180px;
            background: linear-gradient(180deg, rgba(40, 56, 143, 0.12), rgba(40, 56, 143, 0));
            pointer-events: none;
        }

        .yu-verify-inner {
            position: relative;
            z-index: 2;
            min-height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
            padding: 24px 20px 24px;
        }

        .yu-back-btn {
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

        .yu-back-btn:hover {
            background: rgba(40, 56, 143, 0.14);
        }

        .yu-back-btn img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }

        .yu-logo-wrap {
            display: flex;
            justify-content: center;
            margin-top: 6px;
            margin-bottom: 10px;
        }

        .yu-logo {
            width: 92px;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 10px 18px rgba(40, 56, 143, 0.12));
        }

        .yu-badge {
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

        .yu-title {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 8px;
            text-align: center;
            line-height: 1.3;
        }

        .yu-subtitle {
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 22px;
            line-height: 1.7;
        }

        .yu-alert-success,
        .yu-alert-error {
            padding: 14px 16px;
            border-radius: 14px;
            font-size: 13px;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .yu-alert-success {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .yu-alert-error {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .yu-form-box {
            background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(248,250,252,0.96));
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 22px;
            padding: 18px 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }

        .yu-form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 10px;
        }

        .yu-otp-row {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
        }

        .yu-otp-input {
            width: 100%;
            height: 48px;
            border: 1px solid #dbe3f0;
            border-radius: 14px;
            background: #fff;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            outline: none;
            transition: all 0.25s ease;
        }

        .yu-otp-input:focus {
            border-color: #4256d0;
            box-shadow: 0 0 0 4px rgba(66, 86, 208, 0.08);
        }

        .yu-submit-btn {
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
            margin-top: 18px;
        }

        .yu-submit-btn:hover {
            transform: translateY(-1px);
        }

        .yu-footer-space {
            margin-top: auto;
            min-height: 10px;
        }

        @media (max-width: 480px) {
            .yu-verify-shell {
                padding: 0;
            }

            .yu-verify-card {
                max-width: 100%;
                min-height: 100vh;
                border-radius: 0;
            }

            .yu-verify-inner {
                min-height: 100vh;
                padding: 20px 16px;
            }

            .yu-title {
                font-size: 23px;
            }

            .yu-otp-row {
                gap: 6px;
            }

            .yu-otp-input {
                height: 46px;
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="yu-verify-shell">
        <div id="screen6" class="yu-verify-card">
            <div class="yu-verify-glow"></div>

            <div class="yu-verify-inner">
                <div class="mb-4">
                    <a href="{{ route('recoverpassword') }}" class="yu-back-btn">
                        <img src="{{ asset('asset/images/arrow-left.png') }}" alt="Back">
                    </a>
                </div>

                <div class="yu-logo-wrap">
                    <img src="{{ asset('asset/images/Yuwaahlogo.png') }}" alt="YuWaah Logo" class="yu-logo">
                </div>

                @if (session('verifiedotp'))
                    <div class="text-center">
                        <div class="yu-badge">
                            <i class="fas fa-key text-[10px]"></i>
                            Password Update
                        </div>
                    </div>

                    <h1 class="yu-title">Change Password</h1>

                    <div class="yu-alert-success" id="msg">
                        {{ session('verifiedotp') }}
                    </div>

                    <div class="yu-alert-success" id="loginpage" style="display:none">
                        Your password changed successfully,
                        <a href="{{ route('login') }}" class="font-semibold underline">Click here to go to Login Page</a>
                    </div>

                    <div class="yu-alert-error" id="emsg" style="display:none"></div>

                    <div class="yu-form-box">
                        @include('change_password_view')
                    </div>
                @else
                    <div class="text-center">
                        <div class="yu-badge">
                            <i class="fas fa-shield-alt text-[10px]"></i>
                            OTP Verification
                        </div>
                    </div>

                    <h1 class="yu-title">Enter OTP</h1>
                    <p class="yu-subtitle">
                        A 6-digit code has been sent to +91-{{ $mobile }}
                    </p>

                    @if (session('error'))
                        <div class="yu-alert-error">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="yu-form-box">
                        <form action="{{ route('verify.otp.page') }}" method="post" id="formchangepassword">
                            @csrf

                            <div class="mb-4">
                                <label for="d1" class="yu-form-label">OTP</label>

                                <div class="yu-otp-row" id="otp-box-wrap">
                                    <input type="text" name="d1" id="d1" maxlength="1" class="otp-input yu-otp-input">
                                    <input type="text" name="d2" maxlength="1" class="otp-input yu-otp-input">
                                    <input type="text" name="d3" maxlength="1" class="otp-input yu-otp-input">
                                    <input type="text" name="d4" maxlength="1" class="otp-input yu-otp-input">
                                    <input type="text" name="d5" maxlength="1" class="otp-input yu-otp-input">
                                    <input type="text" name="d6" maxlength="1" class="otp-input yu-otp-input">
                                </div>
                            </div>

                            <input type="hidden" name="mobile" value="{{ $mobile }}"/>

                            <button type="submit" class="yu-submit-btn">
                                Submit
                            </button>
                        </form>
                    </div>
                @endif

                <div class="yu-footer-space"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const inputs = document.querySelectorAll('.otp-input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^0-9]/g, '');
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const data = e.clipboardData.getData('text').trim();
                if (/^\d{6}$/.test(data)) {
                    data.split('').forEach((char, i) => {
                        if (inputs[i]) {
                            inputs[i].value = char;
                        }
                    });
                    inputs[5].focus();
                }
            });
        });
    </script>

    <script>
        $('#sbtn').on('click', function (e) {
            e.preventDefault();

            const formData = {
                _token: $('input[name="_token"]').val(),
                password: $('#password').val(),
                cpassword: $('#cpassword').val(),
                mobile: $('#mobile').val()
            };

            $.ajax({
                url: '{{ route("change.password") }}',
                method: 'POST',
                data: formData,
                success: function (response) {
                    $("#emsg").hide();
                    $("#msg").html(response.message).show();
                    $("#formchangepassword").hide();
                    $("#loginpage").show();
                },
                error: function (xhr) {
                    let errorMessage = '';

                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            errorMessage += value + '<br>';
                        });
                    } else {
                        errorMessage = 'Something went wrong. Please try again.';
                    }

                    $("#msg").hide();
                    $("#emsg").html(errorMessage).show();
                }
            });
        });
    </script>
</body>
</html>