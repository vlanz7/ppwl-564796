<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
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
                        <h3 class="mb-4 text-center">Registrasi</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Nama
                                </label>
                                <input type="text" id="name" name="name"
                                    class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>
                                <input type="email" id="email" name="email"
                                    class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Password
                                </label>
                                <input type="password" id="password"
                                    name="password" class="form-control"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label">
                                    Konfirmasi password
                                </label>
                                <input type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control" required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary w-100">
                                Daftar
                            </button>
                        </form>
                        <p class="mt-3 mb-0 text-center">
                            Sudah punya akun?
                            <a href="{{ url('/login') }}">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>