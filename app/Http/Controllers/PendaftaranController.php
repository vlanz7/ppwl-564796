<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $batas = 5;
        $programs = Program::all();
        $jumlahPendaftaran = Pendaftaran::count();
        
        $query = Pendaftaran::with(['peserta', 'program']);
        if ($request->filled('id_program')) {
            $query->where('pendaftarans.id_program', $request->id_program);
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

        // Query statistik tetap mengikuti filter program dan nama
        $statistik = Pendaftaran::query();
        if ($request->filled('id_program')) {
            $statistik->where('pendaftarans.id_program', $request->id_program);
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
        if ($request->filled('id_program')) {
            $biayaTertinggi = Program::where(
                'id_program', $request->id_program
            )->max('biaya');
            $biayaTerendah = Program::where(
                'id_program', $request->id_program
            )->min('biaya');
        } else {
            $biayaTertinggi = Program::max('biaya');
            $biayaTerendah = Program::min('biaya');
        }

        return view('pendaftaran.index', compact(
            'pendaftarans',
            'programs',
            'jumlahPendaftaran',
            'no',
            'totalPendaftaran',
            'totalBiaya',
            'biayaTertinggi',
            'biayaTerendah'
        ));
    }
}
