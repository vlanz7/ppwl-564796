
@extends('layout.template')

@section('title', 'Edit Galeri')

@section('headline')
    <h2 class="herotext">Edit Dokumentasi</h2>
@endsection

@section('subheadline')
    <p class="herotext">
        Perbarui informasi dokumentasi Hoshizora Gakuin
    </p>
@endsection

@section('content')

<div class="galeri-form-container">

    <h2>Form Edit Galeri</h2>

    <form action="{{ route('galeri.update', ['id' => $galeri->id_galeri]) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- Pilih Program --}}
        <div class="form-group">

            <label for="id_program">Program</label>

            <select name="id_program"
                    id="id_program"
                    class="form-control">

                <option value="">-- Pilih Program --</option>

                @foreach ($program as $item)
                    <option value="{{ $item->id_program }}"
                        {{ old('id_program', $galeri->id_program) == $item->id_program ? 'selected' : '' }}>

                        {{ $item->nama_program }}

                    </option>
                @endforeach

            </select>

            @error('id_program')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Judul --}}
        <div class="form-group">

            <label for="judul">Judul Dokumentasi</label>

            <input type="text"
                   name="judul"
                   id="judul"
                   class="form-control"
                   value="{{ old('judul', $galeri->judul) }}">

            @error('judul')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Deskripsi --}}
        <div class="form-group">

            <label for="deskripsi">Deskripsi</label>

            <textarea name="deskripsi"
                      id="deskripsi"
                      class="form-control"
                      rows="4">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>

            @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Foto Lama --}}
        <div class="form-group">

            <label>Foto Saat Ini</label>
            <br>

            <img
                src="{{ asset('storage/' . $galeri->foto) }}"
                alt="{{ $galeri->judul }}"
                class="galeri-preview"
            >

        </div>

        {{-- Foto Baru --}}
        <div class="form-group">

            <label for="foto">Ganti Foto (Opsional)</label>

            <input type="file"
                   name="foto"
                   id="foto"
                   class="form-control-file"
                   accept="image/jpeg,image/png,image/webp">

            <small class="text-muted">
                Kosongkan jika tidak ingin mengganti foto.
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
            </small>

            @error('foto')
                <br>
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Tombol --}}
        <div class="d-flex" style="gap: 10px;">

            <button type="submit" class="btn btn-add">
                Simpan Perubahan
            </button>

            <a href="{{ route('galeri.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection
