<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Giftos</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front_end/css/login.css') }}">
</head>

<body>

<div class="login-wrapper">

    <!-- IMAGE SIDE -->
    <div class="login-image">
        <img src="{{ asset('front_end/images/login2.png') }}" alt="verify email">

        <div class="image-text">
            <h2>Verify Your Email 📩</h2>
            <p>Activate your account and start shopping</p>
        </div>
    </div>

    <!-- FORM SIDE -->
    <div class="login-form">

        <h2>Email Verification</h2>
        <p>Complete your account setup</p>

        <!-- INFO MESSAGE -->
        <div class="mb-3" style="font-size:14px; color:#666; line-height:1.6;">
            Thanks for signing up! Before getting started, please verify your
            email address by clicking the link we just emailed to you.
            If you didn't receive the email, we’ll gladly send another.
        </div>

        <!-- SUCCESS MESSAGE -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-3">
                A new verification link has been sent to your email address.
            </div>
        @endif

        <!-- RESEND EMAIL -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button class="btn-login w-100 mb-3" type="submit">
                <i class="fa fa-paper-plane"></i>
                Resend Verification Email
            </button>
        </form>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                style="
                    background:none;
                    border:none;
                    color:#666;
                    font-size:14px;
                    text-decoration:underline;
                    cursor:pointer;
                ">
                Log Out
            </button>
        </form>

    </div>

</div>

</body>
</html>