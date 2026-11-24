@extends('layout.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Form Pendaftaran Program</h4>
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Silakan lengkapi biodata dan pilih program
                        yang ingin Anda ikuti.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.store') }}"
                          method="POST">
                        @csrf

                        <h5 class="mb-3">A. Informasi Akun</h5>

                        <div class="mb-3">
                            <label class="form-label">Email Akun</label>
                            <input type="email"
                                   class="form-control"
                                   value="{{ auth()->user()->email }}"
                                   readonly>
                        </div>

                        <hr>

                        <h5 class="mb-3">B. Biodata Peserta</h5>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ old('nama', $peserta?->nama) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <input type="text"
                                   name="nomor_hp"
                                   class="form-control"
                                   value="{{ old('nomor_hp', $peserta?->nomor_hp) }}"
                                   maxlength="20"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('alamat', $peserta?->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir"
                                    class="form-select"
                                    required>
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach (['SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2'] as $pendidikan)
                                    <option value="{{ $pendidikan }}"
                                        @selected(old('pendidikan_terakhir', $peserta?->pendidikan_terakhir) == $pendidikan)>
                                        {{ $pendidikan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number"
                                   name="usia"
                                   class="form-control"
                                   value="{{ old('usia', $peserta?->usia) }}"
                                   min="1"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                    class="form-select"
                                    required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki"
                                    @selected(old('jenis_kelamin', $peserta?->jenis_kelamin) == 'Laki-laki')>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    @selected(old('jenis_kelamin', $peserta?->jenis_kelamin) == 'Perempuan')>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <hr>

                        <h5 class="mb-3">C. Pilihan Program</h5>

                        <div class="mb-3">
                            <label class="form-label">Program yang Dipilih</label>
                            <select name="id_program"
                                    class="form-select"
                                    required>
                                <option value="">-- Pilih Program --</option>

                                @foreach ($programs as $program)
                                    <option value="{{ $program->id_program }}"
                                        @selected(old('id_program') == $program->id_program)>
                                        {{ $program->nama_program }}
                                        - Rp{{ number_format($program->biaya, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('home') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Kirim Pendaftaran
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
