<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        select {
            padding: 8px;
            width: 250px;
        }
        button {
            padding: 8px 15px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .statistik-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
        .statistik-box {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f2f2f2;
        }
        .statistik-box h3 {
            font-size: 16px;
        }
        .statistik-box p {
            font-size: 22px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Data Pendaftaran Program LPK</h1>
    <form action="{{ route('pendaftaran.index') }}" method="GET">
        <label for="id_program">Filter Berdasarkan Program:</label>
        <select name="id_program" id="id_program">
            <option value="">Semua Program</option>
            @foreach ($programs as $program)
                <option
                    value="{{ $program->id_program }}"
                    {{ request('id_program') == $program->id_program ? 'selected' : '' }}
                >
                    {{ $program->nama_program }}
                </option>
            @endforeach
        </select>
        <button type="submit">
            Filter
        </button>
    </form>
    
    <form action="{{ route('pendaftaran.index') }}" method="GET">
        <label for="nama">Cari Nama Peserta:</label>
        <input
            type="text"
            name="nama"
            id="nama"
            placeholder="Masukkan nama peserta"
            value="{{ request('nama') }}"
        >
        <input
            type="hidden"
            name="id_program"
            value="{{ request('id_program') }}"
        >
        <button type="submit">Cari</button>
    </form>
    <table>
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
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pendaftaran->peserta->nama }}</td>
                    <td>{{ $pendaftaran->program->nama_program }}</td>
                    <td>{{ $pendaftaran->tanggal_pendaftaran }}</td>
                    <td>{{ $pendaftaran->status_pendaftaran }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data pendaftaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Statistik Pendaftaran</h2>
    <div class="statistik-container">
        <div class="statistik-box">
            <h3>Total Pendaftaran</h3>
            <p>{{ $totalPendaftaran }}</p>
        </div>
        <div class="statistik-box">
            <h3>Total Biaya Program</h3>
            <p>Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
        </div>
        <div class="statistik-box">
            <h3>Biaya Tertinggi</h3>
            <p>Rp {{ number_format($biayaTertinggi ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="statistik-box">
            <h3>Biaya Terendah</h3>
            <p>Rp {{ number_format($biayaTerendah ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>
</body>
</html>