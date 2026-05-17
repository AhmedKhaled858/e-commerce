<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Giftos</title>

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
        <img src="{{ asset('front_end/images/login2.png') }}" alt="forgot password">

        <div class="image-text">
            <h2>Forgot Password? 🔐</h2>
            <p>We’ll send you a reset link to your email</p>
        </div>
    </div>

    <div class="login-form">

        <h2>Reset Password</h2>
        <p>Enter your email to receive a reset link</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <div class="input-box">
                    <i class="fa fa-envelope"></i>
                    <input type="email"
                           name="email"
                           placeholder="Enter your email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="@error('email') is-invalid @enderror">
                </div>

                @error('email')
                    <small class="text-danger d-block mt-1">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- BUTTON -->
            <button class="btn-login" type="submit">
                Send Reset Link
            </button>

        </form>

        <!-- BACK TO LOGIN -->
        <div class="small-text mt-3">
            Remember your password?
            <a href="{{ route('login') }}">Login</a>
        </div>

    </div>

</div>

</body>
</html>