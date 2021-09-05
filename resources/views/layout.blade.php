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
    {{-- This is saying that any content from the view will be yielded --}}
    @yield('content')
</body>

</html>
