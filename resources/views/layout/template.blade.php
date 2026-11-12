<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css">
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
                <li>@auth
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    Logout                    
                </button>
            </form>
        @endauth</li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            @yield('headline')
            @yield('subheadline')
            <button>@yield('buttonText')</button>
        </section>
        <section>
            @yield('content')
        </section>
    </main>

    <footer>
        <div class="footer-col">Alamat:<br>@yield('alamat')</div>
        <div class="footer-col">Sosial Media:<br>@yield('sosialmedia')</div>
        <p>&copy; @yield('copyright')</p>
    </footer>

    <script src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.date').datepicker({format: 'yyyy/mm/dd', autoclose: true});
        });
    </script>
</body>
</html>