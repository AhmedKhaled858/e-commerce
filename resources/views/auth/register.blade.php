<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Giftos</title>

    <link href="{{asset('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('front_end/css/register.css') }}">

</head>

<body>

    <div class="register-wrapper">
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
        <div class="register-image">
            <img src="{{ asset('front_end/images/login1.jfif') }}" alt="register">

            <div class="image-text">
                <h2>Create Account 🚀</h2>
                <p>Join us and start your journey</p>
            </div>
        </div>

        <!-- FORM SIDE -->
        <div class="register-form">

            <h2>Register</h2>
            <p>Create your new account</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-user"></i>
                        <input type="text" name="name" placeholder="Full Name" required
                            value="{{ old('name') }}" class="@error('name') is-invalid @enderror">


                    </div>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror">


                    </div>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password"
                            class="@error('password') is-invalid @enderror">

                    </div>

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="mb-3">
                    <div class="input-box">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password"
                            class="@error('password_confirmation') is-invalid @enderror">


                    </div>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <button class="btn-register" type="submit">
                    Create Account
                </button>
            </form>

            <div class="small-text">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </div>

    </div>
    <script src="{{ asset('front_end/js/timeout.js') }}"></script>

</body>

</html>
