@extends('layout.template')

@section('title', 'Galeri Program')

@section('headline')
    <h2 class="herotext">Galeri Hoshizora Gakuin</h2>
@endsection

@section('subheadline')
    <p class="herotext">
        Dokumentasi kegiatan dan program Hoshizora Gakuin
    </p>
@endsection

@if (auth()->user()->level === 'admin')
    @section('buttonText', 'Tambah Foto')
    @section('buttonLink')
        {{ route('galeri.create') }}
    @endsection
@endif

@section('content')

<div class="galeri-container">

    <div class="galeri-header"> <h2>Dokumentasi Program</h2> </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($galeri->count() > 0)
        <div class="galeri-grid">
            @foreach ($galeri as $item)
                <div class="galeri-card">
                    <a href="{{ asset('storage/'.$item->foto) }}"
                        data-lightbox="galeri-program"
                        data-title="{{ $item->judul }}">
                        <img src="{{ asset('storage/'.$item->foto) }}"
                            alt="{{ $item->judul }}"
                            class="galeri-image">
                    </a>
                    <h3>{{ $item->judul }}</h3>
                    <p class="galeri-program">
                        Program:
                        {{ $item->program->nama_program ?? 'Program tidak tersedia' }}
                    </p>
                    <p>
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>
                    {{-- Tombol khusus Admin --}}
                    @if (auth()->user()->level === 'admin')
                        <div class="galeri-actions">
                            <a href="{{ route('galeri.edit', ['id' => $item->id_galeri]) }}"
                               class="btn btn-edit">
                                Edit
                            </a>
                            <form
                                action="{{ route('galeri.destroy', ['id' => $item->id_galeri]) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus foto ini?')"                    
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="galeri-pagination">{{ $galeri->links() }}</div>
    @else
        <div class="galeri-empty">
            <h4>Belum Ada Dokumentasi</h4>
            <p>Dokumentasi foto program belum tersedia.</p>
        </div>
    @endif
</div>
@endsection