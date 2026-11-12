<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="mb-4 text-center">Login</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>
                                <input type="email" id="email" name="email"
                                    class="form-control"
                                    value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Password
                                </label>
                                <input type="password" id="password"
                                    name="password" class="form-control" required>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember"
                                    id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">
                                    Ingat saya
                                </label>
                            </div>
                            <button type="submit"
                                class="btn btn-primary w-100">
                                Login
                            </button>
                        </form>

                        <p class="mt-3 mb-0 text-center">
                            Belum punya akun?
                            <a href="{{ url('/register') }}">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>