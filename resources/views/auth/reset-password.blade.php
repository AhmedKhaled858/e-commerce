<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Giftos</title>

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
            <img src="{{ asset('front_end/images/login2.png') }}" alt="reset password">

            <div class="image-text">
                <h2>Set New Password 🔐</h2>
                <p>Choose a strong password for your account</p>
            </div>
        </div>

        <div class="login-form">

            <h2>Reset Password</h2>
            <p>Enter your new password below</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}"
                            placeholder="Email" required autofocus class="@error('email') is-invalid @enderror">
                    </div>

                    @error('email')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="New Password" required
                            class="@error('password') is-invalid @enderror">
                    </div>

                    @error('password')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                            class="@error('password_confirmation') is-invalid @enderror">
                    </div>

                    @error('password_confirmation')
                        <small class="text-danger d-block mt-1">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <button class="btn-login" type="submit">
                    Reset Password
                </button>

            </form>

        </div>

    </div>

</body>

</html>
