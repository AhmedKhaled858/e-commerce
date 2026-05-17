<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Giftos</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/login.css') }}">
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

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required
                            class="@error('email') is-invalid @enderror">
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

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('password.request') }}" class="text-primary" style="font-size: 14px;">
                        Forgot Password?
                    </a>
                </div>

                <!-- LOGIN BUTTON -->
                <button class="btn-login" type="submit">
                    Login
                </button>

            </form>

            <!-- REGISTER LINK -->
            <div class="small-text mt-3">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </div>

    </div>

    <script src="{{ asset('front_end/js/timeout.js') }}"></script>

</body>

</html>
