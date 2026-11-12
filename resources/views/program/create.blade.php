<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css">
    <title>Tambah Program</title>
</head>
<body>
    <header>
        <h1>Penambahan Program</h1>
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
        <section>
            <div class="container">
                <h4>Tambah Program</h4>
                
                @if (count($errors)>0)
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="post" action="{{route('program.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div>Nama Program <input type="text" name="nama"></div>
                    <div>Deskripsi <input type="text" name="deskripsi"></div>
                    <div>Biaya <input type="text" name="biaya"></div>
                    <div>Durasi<input type="text" name="durasi"></div>
                    <div>Kuota <input type="text" name="kuota"></div>
                    <div>Dokumen <input type="text" name="dokumen"></div>
                    <div class="form-group">
                        <label for="gambar">Gambar Program</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg,.png" required>
                        <small class="form-text text-muted"> Format: JPG, JPEG, PNG. Maksimal 2 MB. </small>
                    </div>
                    <button type="submit">Simpan</button>
                    <a href="{{'/home'}}">Kembali</a>
                </form>
            </div>
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