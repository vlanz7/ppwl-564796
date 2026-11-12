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
    @if (count($data_program))
        <div class="alert alert-success">
            Ditemukan <strong>{{ $jumlah_program }}</strong>
            data program dengan kata: <strong>{{ $cari }}</strong>
        </div>

        <div class="program-header">
            <h2>Hasil Pencarian Program</h2>
            <a  href="{{ url('/home') }}"class="btn btn-add">Kembali ke Program</a>
        </div>

        <div class="program-grid">
            @foreach ($data_program as $program)
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
                </div>
            @endforeach
        </div>
        {{ $data_program->links() }}
    @else
        <div class="alert alert-warning">
            <h4>Data program "{{ $cari }}" tidak ditemukan</h4>
            <a  href="{{ url('/home') }}" class="btn btn-warning">Kembali</a>
        </div>
    @endif
@endsection