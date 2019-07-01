<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width,initial-scale=1" />
</head>
<body>
    <header>
        <span>@yield('title')</span>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
