@extends('layout.template')

@section('title')
    Hoshizora Gakuin
@endsection

@section('headline')
    <h1 align="center" class="herotext">Wujudkan Mimpimu Bekerja di Jepang</h1>
@endsection

@section('subheadline')
    <h3 align="center" class="herotext">Program pelatihan bahasa Jepang dan persiapan kerja terlengkap dengan bimbingan instruktur berpengalaman.</h3>
@endsection

@section('buttonText')
    Lihat Program!
@endsection

@section('alamat')
    Setiabudi, Jakarta Selatan
@endsection

@section('sosialmedia')
    @hoshizoragakuin
@endsection

@section('copyright')
    2026 Hoshizora Gakuin
@endsection

@section('content')
    @if (Session::has('pesan'))
        <div class="alert alert-success">
            {{ Session::get('pesan') }}
        </div>
    @endif

    <div class="program-header">
        <h2>Program yang Kami Tawarkan</h2>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('program.create') }}" class="btn btn-add">
                + Tambah Program
            </a>
        </div>
    </div>

    <form action="{{ route('program.search') }}" method="GET"
        style="clear: both; display: flex; justify-content: flex-end; gap: 8px; margin: 10px 0 20px;">
        <input type="text" name="kata" class="form-control"
            placeholder="Cari program..." style="width: 30%;">
    </form>

    <div class="program-grid">
        @forelse ($programs as $program)
            <div class="program-card">
                <img src="{{ asset('storage/' . $program->gambar) }}"
                    alt="Gambar {{ $program->nama_program }}"
                    class="program-image">
                <h3>{{ $program->nama_program }}</h3>
                <p>{{ $program->deskripsi }}</p>
                <p><strong>Biaya:</strong> Rp {{ number_format($program->biaya, 0, ',', '.') }}</p>
                <p><strong>Durasi:</strong> {{ $program->durasi }}</p>
                <p><strong>Kuota:</strong> {{ $program->kuota }}</p>
                <p><strong>Dokumen wajib:</strong> {{ $program->dokumen_wajib }}</p>

                <div class="program-actions">
                    <a href="{{ route('program.edit', $program->id_program) }}" class="btn btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('program.destroy', $program->id_program) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="empty-message">
                Belum ada program yang ditambahkan.
            </p>
        @endforelse
    </div>
@endsection
