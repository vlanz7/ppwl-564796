<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <header>
        <h1>@yield('title')</h1>
    <nav>
        <ul>
            @auth
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('galeri.index') }}"class="{{ request()->routeIs('galeri.*') ? 'active' : '' }}">Galeri</a></li>
                @if (auth()->user()->level === 'admin')
                    <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
                @elseif (auth()->user()->level === 'user')
                    <li><a href="{{ route('pendaftaran.create') }}"class="nav-link">Pendaftaran</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
    </header>

    <main>
        <section class="hero">
            @yield('headline')
            @yield('subheadline')
            @hasSection('buttonText')
                <a href="@yield('buttonLink')" class="btn btn-add">@yield('buttonText')</a>
            @endif
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/lightbox.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function () {
            $('.date').datepicker({format: 'yyyy/mm/dd', autoclose: true});
        });
    </script>
</body>
</html>