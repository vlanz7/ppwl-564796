<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>@yield('title')</h1>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Program</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            @yield('headline')
            @yield('subheadline')
            <button>@yield('buttonText')</button>
        </section>
        <h3 align="center">@yield('informasi')</h3>
        <section class="cards">
            <div class="card">@yield('poin1')</div>
            <div class="card">@yield('poin2')</div>
            <div class="card">@yield('poin3')</div>
        </section>
    </main>

    <footer>
        <div class="footer-col">Alamat:<br>@yield('alamat')</div>
        <div class="footer-col">Sosial Media:<br>@yield('sosialmedia')</div>
        <p>&copy; @yield('copyright')</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>