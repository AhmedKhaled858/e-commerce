<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password - Giftos</title>

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
        <img src="{{ asset('front_end/images/login2.png') }}" alt="confirm password">

        <div class="image-text">
            <h2>Secure Area 🔒</h2>
            <p>Please confirm your password to continue</p>
        </div>
    </div>

    <div class="login-form">

        <h2>Confirm Password</h2>
        <p>This step protects your account security</p>

        <div class="mb-3" style="font-size: 14px; color: #666;">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-3">
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password"
                           name="password"
                           placeholder="Enter your password"
                           required
                           autocomplete="current-password"
                           class="@error('password') is-invalid @enderror">
                </div>

                @error('password')
                    <small class="text-danger d-block mt-1">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- BUTTON -->
            <button class="btn-login" type="submit">
                Confirm Password
            </button>

        </form>

    </div>

</div>

</body>
</html>