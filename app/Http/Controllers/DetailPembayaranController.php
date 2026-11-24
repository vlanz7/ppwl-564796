<?php

namespace App\Http\Controllers;

use App\Models\DetailPembayaran;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPembayaranController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'jumlah_bayar' => 'required|numeric|min:1',
            'tanggal_bayar' => 'required|date',
            'metode_pembayaran' => ['required', 'in:Transfer Bank,QRIS,Lainnya'],
        ]);
        $pendaftaran = Pendaftaran::with('peserta')->findOrFail($id);
        if ($request->user()->level === 'user' && $pendaftaran->peserta->user_id !== $request->user()->getAuthIdentifier()
        ) {
            abort(403);
        }
        DB::transaction(function () use ($pendaftaran, $validated) {
            $pembayaran = Pembayaran::firstOrCreate(
                ['id_pendaftaran' => $pendaftaran->id_pendaftaran,],
                [
                    'total_biaya' => $pendaftaran->program->biaya,
                    'total_terbayar' => 0,
                    'status_pembayaran' => 'Menunggu',
                ]
            );
            DetailPembayaran::create([
                'id_pembayaran' => $pembayaran->id_pembayaran,
                'jumlah_bayar' => $validated['jumlah_bayar'],
                'tanggal_bayar' => $validated['tanggal_bayar'],
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'status_cicilan' => 'Menunggu',
            ]);
        });
        return back()->with('pesan', 'Data pembayaran berhasil dikirim dan menunggu verifikasi.');
    }

    public function verify($id)
    {
        $detail = DetailPembayaran::with('pembayaran')->findOrFail($id);
        DB::transaction(function () use ($detail) {
            if ($detail->status_cicilan !== 'Menunggu') {
                abort(422, 'Pembayaran ini sudah diproses.');
            }
            $detail->status_cicilan = 'Diverifikasi';
            $detail->verified_at = now();
            $detail->save();
            $pembayaran = $detail->pembayaran;
            $pembayaran->total_terbayar =
                $pembayaran->detailPembayaran()
                    ->where('status_cicilan', 'Diverifikasi')
                    ->sum('jumlah_bayar');
            $pembayaran->save();
        });
        return back()->with('pesan', 'Pembayaran berhasil diverifikasi.');
    }

    public function reject($id)
    {
        $detail = DetailPembayaran::findOrFail($id);
        if ($detail->status_cicilan !== 'Menunggu') {
            return back()->with('pesan', 'Pembayaran ini sudah diproses.');
        }
        $detail->status_cicilan = 'Ditolak';
        $detail->verified_at = now();
        $detail->save();
        return back()->with('pesan', 'Pembayaran berhasil ditolak.');
    }
}