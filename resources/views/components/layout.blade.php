<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/app.css">
    <link rel="stylesheet" href="/foo.css">
    <title>My Blog</title>
</head>

<body>
    <header>
        @yield('header-banner')
    </header>
    {{-- $slot is something you can think of your default slot component --}}
    {{ $slot }}
</body>

</html>
