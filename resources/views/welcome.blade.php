<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Base styles */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: white;
            color: black;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        .header {
            background-color: #1a202c;
            color: white;
            padding: 10px;
            text-align: right;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
        }

        /* Main content styles */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .main-content h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Call to action styles */
        .cta {
            text-align: center;
            margin-top: 40px;
        }

        .cta a {
            background-color: #4299e1;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
        }

        .cta a:hover {
            background-color: #3182ce;
        }
    </style>
</head>
<body>
    <div class="header">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif
    </div>

    <div class="main-content">
        <h1>Welcome to Stream Events App!</h1>
        <p>
            Stream Events App is a fantastic platform for managing your events. Log in to explore all the amazing features.
        </p>

        <div class="cta">
            <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
</body>
</html>
