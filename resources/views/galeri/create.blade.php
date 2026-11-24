
@extends('layout.template')

@section('title', 'Tambah Galeri')

@section('headline')
    <h2 class="herotext">Tambah Dokumentasi</h2>
@endsection

@section('subheadline')
    <p class="herotext">
        Tambahkan foto kegiatan program Hoshizora Gakuin
    </p>
@endsection

@section('content')

<div class="galeri-form-container">

    <h2>Form Tambah Galeri</h2>

    <form action="{{ route('galeri.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        {{-- Pilih Program --}}
        <div class="form-group">

            <label for="id_program">Program</label>

            <select name="id_program"
                    id="id_program"
                    class="form-control">

                <option value="">-- Pilih Program --</option>

                @foreach ($program as $item)
                    <option value="{{ $item->id_program }}"
                        {{ old('id_program') == $item->id_program ? 'selected' : '' }}>

                        {{ $item->nama_program }}

                    </option>
                @endforeach

            </select>

            @error('id_program')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Judul Foto --}}
        <div class="form-group">

            <label for="judul">Judul Dokumentasi</label>

            <input type="text"
                   name="judul"
                   id="judul"
                   class="form-control"
                   value="{{ old('judul') }}"
                   placeholder="Masukkan judul dokumentasi">

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
                      rows="4"
                      placeholder="Masukkan deskripsi kegiatan">{{ old('deskripsi') }}</textarea>

            @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        {{-- Upload Foto --}}
        <div class="form-group">

            <label for="foto">Foto Dokumentasi</label>

            <input type="file"
                   name="foto"
                   id="foto"
                   class="form-control-file"
                   accept="image/jpeg,image/png,image/webp">

            <small class="text-muted">
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
                Simpan
            </button>

            <a href="{{ route('galeri.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection
