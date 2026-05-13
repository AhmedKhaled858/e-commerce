<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Giftos</title>

  <link rel="stylesheet" href="{{ asset('front_end/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('front_end/css/style.css') }}">
</head>

<body>

  @include('partials.header')

  @yield('content')

  @include('partials.footer')

</body>
</html>