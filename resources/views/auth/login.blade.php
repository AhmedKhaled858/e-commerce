<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Giftos</title>

    <link href="{{asset('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/login.css') }}">

</head>

<body>

    <div class="login-wrapper">
        <div class="heading_container heading_center mb-5 position-relative">
            @if (session('success'))
                <script>
                    window.flashSuccess = @json(session('success'));
                </script>
            @endif

            @if (session('error'))
                <script>
                    window.flashError = @json(session('error'));
                </script>
            @endif
        </div>

        <!-- IMAGE SIDE -->
        <div class="login-image">
            <img src="{{ asset('front_end/images/login2.png') }}" alt="login">

            <div class="image-text">
                <h2>Welcome Back 👋</h2>
                <p>Login to continue your journey</p>
            </div>
        </div>

        <!-- FORM SIDE -->
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

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required
                            class="@error('email') is-invalid @enderror">
                    </div>
                    @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <button class="btn-login" type="submit">
                    Login
                </button>
            </form>

            <div class="small-text">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </div>

    </div>
    <script src="{{ asset('front_end/js/timeout.js') }}"></script>
</body>

</html>
