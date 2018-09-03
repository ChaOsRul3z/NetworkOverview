<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <title>SLP | {{ config('app.name', '') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>

<header>
    @include('layouts.partials.navigation')
</header>

<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partials.errors')
            </div>
        </div>
    </div>
    @yield('content')
</div>

<footer>
    @include('layouts.partials.footer')
</footer>
<script src="{{ elixir('js/app.js') }}"></script>

@yield('javascript')
<script>
    $(".alert").fadeTo(4000, 500).slideUp(500, function () {
        $(".alert").slideUp(500);
    });
</script>
</body>
</html>