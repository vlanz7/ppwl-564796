<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Program;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $programs = Program::all();
        if ($request->filled('id_program')) {
            $pendaftarans = Pendaftaran::with(['peserta', 'program'])
                ->where('id_program', $request->id_program)
                ->whereHas('peserta', function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->nama . '%');
                })
                ->latest('tanggal_pendaftaran')
                ->get();
        }
        else {
            $pendaftarans = Pendaftaran::with(['peserta', 'program'])
                ->whereHas('peserta', function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->nama . '%');
                })
                ->latest('tanggal_pendaftaran')
                ->get();
        }

        if ($request->filled('id_program')) {
            $totalPendaftaran = Pendaftaran::where(
                'id_program', $request->id_program
            )->whereHas('peserta', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            })->count();
            $totalBiaya = Pendaftaran::join(
                'program', 'pendaftarans.id_program', '=', 'program.id_program'
            )->where(
                'pendaftarans.id_program', $request->id_program
            )->whereHas('peserta', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            })->sum('program.biaya');
            $biayaTertinggi = Program::where(
                'id_program', $request->id_program
            )->max('biaya');
            $biayaTerendah = Program::where(
                'id_program', $request->id_program
            )->min('biaya');
        }
        else {
            $totalPendaftaran = Pendaftaran::whereHas('peserta', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            })->count();
            $totalBiaya = Pendaftaran::join(
                'program', 'pendaftarans.id_program', '=', 'program.id_program'
            )->whereHas('peserta', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            })->sum('program.biaya');
            $biayaTertinggi = Program::max('biaya');
            $biayaTerendah = Program::min('biaya');
        }
        return view('pendaftaran.index', compact('pendaftarans','programs','totalPendaftaran',
        'totalBiaya',
        'biayaTertinggi',
        'biayaTerendah'));
    }
}
