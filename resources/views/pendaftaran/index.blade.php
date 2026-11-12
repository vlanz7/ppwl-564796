@extends('layout.template')

@section('title')
    Data Pendaftaran
@endsection

@section('headline')
    <h2 class="herotext">Data Pendaftaran Program LPK</h2>
@endsection

@section('subheadline')
    <p class="herotext">Kelola dan pantau data pendaftaran peserta.</p>
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
    <div class="pendaftaran-container">

        {{-- Filter program --}}
        <form action="{{ route('pendaftaran.index') }}"
              method="GET"
              class="filter-form">
            <label for="id_program">Filter Berdasarkan Program:</label>

            <select name="id_program" id="id_program">
                <option value="">Semua Program</option>

                @foreach ($programs as $program)
                    <option value="{{ $program->id_program }}"
                        {{ request('id_program') == $program->id_program ? 'selected' : '' }}>
                        {{ $program->nama_program }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-add">Filter</button>
        </form>

        {{-- Pencarian peserta --}}
        <form action="{{ route('pendaftaran.index') }}"
              method="GET"
              class="search-form">
            <label for="nama">Cari Nama Peserta:</label>

            <input type="text"
                   name="nama"
                   id="nama"
                   placeholder="Masukkan nama peserta"
                   value="{{ request('nama') }}">

            <input type="hidden"
                   name="id_program"
                   value="{{ request('id_program') }}">

            <button type="submit" class="btn btn-add">Cari</button>
        </form>

        {{-- Filter berdasarkan tanggal pendaftaran --}}
        <form action="{{ route('pendaftaran.index') }}" method="GET" class="date-filter-form">
            <label for="tanggal">Pilih Tanggal Pendaftaran:</label>
            <input type="text" name="tanggal" id="tanggal" class="date" 
            placeholder="Pilih tanggal"value="{{ request('tanggal') }}" autocomplete="off">
            <input type="hidden" name="id_program" value="{{ request('id_program') }}">
            <input type="hidden" name="nama" value="{{ request('nama') }}">
            <button type="submit" class="btn btn-add">Cari Tanggal</button>
            <a href="{{ route('pendaftaran.index') }}" class="btn btn-edit"> Reset </a>
        </form>

        {{-- Tabel pendaftaran --}}
        <div class="table-wrapper">
            <table class="pendaftaran-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Program</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pendaftarans as $pendaftaran)
                        <tr>
                            <td>{{ $no + $loop->iteration }}</td>
                            <td>{{ $pendaftaran->peserta->nama }}</td>
                            <td>{{ $pendaftaran->program->nama_program }}</td>
                            <td>{{ $pendaftaran->tanggal_pendaftaran->format('d/m/Y') }}</td>
                            <td>{{ $pendaftaran->status_pendaftaran }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-message">
                                Belum ada data pendaftaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div> {{ $pendaftarans->links('pagination::bootstrap-4')  }} </div>
            <div><strong>Jumlah Pendaftaran: {{ $jumlahPendaftaran }}</strong></div>
        </div>
        

        {{-- Statistik pendaftaran --}}
        <h2 class="section-title">Statistik Pendaftaran</h2>
        <div class="program-grid">
            <div class="program-card">
                <h3>Total Pendaftaran</h3>
                <p>{{ $totalPendaftaran }}</p>
            </div>
            <div class="program-card">
                <h3>Total Biaya Program</h3>
                <p>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
            </div>
            <div class="program-card">
                <h3>Biaya Tertinggi</h3>
                <p>Rp {{ number_format($biayaTertinggi ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="program-card">
                <h3>Biaya Terendah</h3>
                <p>Rp {{ number_format($biayaTerendah ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
@endsection