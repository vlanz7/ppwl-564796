<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker3.min.css">
    <title>Edit Program</title>
</head>

<body>
    <header>
        <h1>Edit Program</h1>
    </header>
    <main>
        <form method="POST"
              action="{{ route('program.update', $program->id_program) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>Nama Program<input type="text" name="nama" value="{{ $program->nama_program }}"></div>
            <div>Deskripsi <input type="text" name="deskripsi" value="{{ $program->deskripsi }}"></div>
            <div>Biaya <input type="text" name="biaya" value="{{ $program->biaya }}"></div>
            <div>Durasi <input type="text" name="durasi" value="{{ $program->durasi }}"></div>
            <div>Kuota <input type="text" name="kuota" value="{{ $program->kuota }}"></div>
            <div>Dokumen <input type="text" name="dokumen" value="{{ $program->dokumen_wajib }}"></div>
            <div class="form-group">
                <label>Gambar Program Saat Ini</label>
                <div>
                    @if ($program->gambar)
                        <img src="{{ asset('storage/' . $program->gambar) }}"
                            alt="Gambar {{ $program->nama_program }}"
                            width="250">
                    @else
                        <p>Belum ada gambar.</p>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="gambar">Ganti Gambar Program</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept=".jpg,.jpeg,.png">
                <small class="form-text text-muted">
                    Kosongkan jika tidak ingin mengganti gambar.
                    Format JPG, JPEG, PNG. Maksimal 2 MB.
                </small>
            </div>
            <button type="submit">Update</button>
            <a href="{{ url('/home') }}">Kembali</a>
        </form>
    </main>
    <footer>
        <div class="footer-col">Alamat:<br>@yield('alamat')</div>
        <div class="footer-col">Sosial Media:<br>@yield('sosialmedia')</div>
        <p>&copy; @yield('copyright')</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>