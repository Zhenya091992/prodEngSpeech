<!DOCTYPE html>
<html lang="us">
<head>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('headers')
</head>
<body>
<div class="container">
    @if(\Illuminate\Support\Facades\Auth::hasUser())
        @include('authHeader')
    @else
        @include('header')
    @endif

    @yield('errs')

    @yield('content')

</div>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
