<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Program;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $batas = 5;
        $programs = Program::all();
        $query = Pendaftaran::with([
            'peserta.user',
            'program',
            'pembayaran'
        ]);
        if ($request->filled('id_program')) {
            $query->where('id_program', $request->id_program);
        }
        if ($request->filled('nama')) {
            $query->whereHas('peserta', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pendaftaran', $request->tanggal);
        }
        $pendaftarans = $query
            ->latest('tanggal_pendaftaran')
            ->paginate($batas)
            ->withQueryString();
        $no = $batas * ($pendaftarans->currentPage() - 1);
        $statistik = Pendaftaran::query();
        if ($request->filled('id_program')) {
            $statistik->where('id_program', $request->id_program);
        }
        if ($request->filled('nama')) {
            $statistik->whereHas('peserta', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }
        if ($request->filled('tanggal')) {
            $statistik->whereDate('tanggal_pendaftaran', $request->tanggal);
        }
        $totalPendaftaran = (clone $statistik)->count();
        $totalBiaya = (clone $statistik)
            ->join('program', 'pendaftarans.id_program', '=', 'program.id_program')
            ->sum('program.biaya');
        $biayaTertinggi = Program::max('biaya');
        $biayaTerendah = Program::min('biaya');
        if ($request->filled('id_program')) {
            $biayaTertinggi = Program::where('id_program', $request->id_program)->max('biaya');
            $biayaTerendah = Program::where('id_program', $request->id_program)->min('biaya');
        }
        $jumlahPendaftaran = Pendaftaran::count();
        $admins = User::where('level', 'admin')
            ->latest()
            ->get();
        return view('pendaftaran.index', compact(
            'pendaftarans',
            'programs',
            'jumlahPendaftaran',
            'no',
            'totalPendaftaran',
            'totalBiaya',
            'biayaTertinggi',
            'biayaTerendah',
            'admins'
        ));
    }

    public function store(Request $request)
    {
        if ($request->user()->level !== 'user') {abort(403);}
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nomor_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => [
                'required',
                'in:SMP,SMA/SMK,D1,D2,D3,D4,S1,S2'
            ],
            'usia' => 'required|integer|min:1',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_program' => 'required|exists:program,id_program',
        ]);

        $pendaftaran = DB::transaction(function () use ($validated, $request) {
            $peserta = Peserta::updateOrCreate(
                ['user_id' => $request->user()->id],
                [
                    'nama' => $validated['nama'],
                    'nomor_hp' => $validated['nomor_hp'],
                    'alamat' => $validated['alamat'],
                    'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
                    'usia' => $validated['usia'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                ]
            );
            return Pendaftaran::create([
                'id_peserta' => $peserta->id_peserta,
                'id_program' => $validated['id_program'],
                'status_pendaftaran' => 'Menunggu',
            ]);
        });
        return redirect()->route('home')->with('pesan', 'Pendaftaran program berhasil dikirim.');
    }

    public function create(Request $request)
    {
        if ($request->user()->level !== 'user') {abort(403);}
        $programs = Program::orderBy('nama_program')->get();
        $peserta = $request->user()->peserta;
        return view('pendaftaran.create', compact('programs', 'peserta'));
    }
}