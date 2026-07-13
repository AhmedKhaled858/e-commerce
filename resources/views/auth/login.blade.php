<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .social-login {
    display: flex;
    justify-content: center;
    align-items: center;
}

.google-login {
    width: 55px;
    height: 55px;
    border: 1px solid #e5e5e5;
    border-radius: 50%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transition: all .3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,.08);
}

.google-login:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,.15);
}

.google-login img {
    width: 28px;
    height: 28px;
}
        /* Modern Auth Divider */
        .auth-divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #8c8c8c;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .auth-divider:not(:empty)::before {
            margin-right: .75em;
        }

        .auth-divider:not(:empty)::after {
            margin-left: .75em;
        }

        /* Custom Google Button Styling (If choosing Option B) */
        .btn-google-auth {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            color: #1f1f1f;
            border: 1px solid #747775;
            border-radius: 4px;
            padding: 10px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-google-auth:hover {
            background-color: #f8f9fa;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
            color: #1f1f1f;
        }

        .btn-google-auth img {
            width: 18px;
            height: 18px;
            margin-right: 10px;
        }

        /* UI Polishing adjustments */
        .forget-password-link {
            font-size: 13px;
            color: #6c757d;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forget-password-link:hover {
            color: #0d6efd;
        }

        .btn-login {
            width: 100%;
            padding: 11px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 500;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Giftos</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/login.css') }}">
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>

    <div class="login-wrapper">

        @include('partials.flash_messages')
        <div class="login-image">
            <img src="{{ asset('front_end/images/login2.png') }}" alt="login">

            <div class="image-text">
                <h2>Welcome Back 👋</h2>
                <p>Login to continue your journey</p>
            </div>
        </div>

        <div class="login-form">

            <h2>Login</h2>
            <p>Access your account</p>

            <div id="g_id_onload"
                 data-client_id="YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com"
                 data-login_uri="{{ route('google.login') }}"
                 data-auto_prompt="false">
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required
                            class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                    </div>

                    @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-2">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required
                            class="@error('password') is-invalid @enderror">
                    </div>

                    @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mb-4">
                    <a href="{{ route('password.request') }}" class="forget-password-link">
                        Forgot Password?
                    </a>
                </div>

                <button class="btn-login mb-3" type="submit">
                    Login
                </button>
            </form>

            <div class="auth-divider my-4">
                <span>or continue with</span>
            </div>

            <div class="social-login">
    <a href="{{ route('google.login') }}" class="google-login">
        <img src="https://developers.google.com/identity/images/g-logo.png"
             alt="Google">
    </a>
</div>

            <div class="small-text mt-4 text-center">
                Don't have an account?
                <a href="{{ route('register') }}" class="fw-semibold text-decoration-none">Register</a>
            </div>

        </div>

    </div>

    <script src="{{ asset('front_end/js/timeout.js') }}"></script>

</body>

</html>