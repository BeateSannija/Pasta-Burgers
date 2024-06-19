<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Laravel</title>
</head>
<body>
    <div>
        <nav class="navbar">
            <ul id="navbar-list">
                <li class="nav-item"><a href="index.html"><img id="logo" src="images/PASTA-BURGERS-uzraksts-bez-fona.png" alt="Pasta Burgers"></a></li>
                <li class="nav-item"><a href="#menu-caption">Ēdienkarte</a></li>
                <li class="nav-item"><a href="#about-us">Par mums</a></li>
                <li class="nav-item"><a href="#footer">Kontakti</a></li>
                <li class="nav-item" id="to-order"><a href="#order">Pasūtījums</a></li>
            </ul>
        </nav>
    </div>
    <div> 
    @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
        @endauth
    </div>
</body>
</html>


