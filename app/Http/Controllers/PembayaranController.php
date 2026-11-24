<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function show(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with([
            'peserta.user',
            'program',
            'pembayaran.detailPembayaran'
        ])->findOrFail($id);
        if ($request->user()->level === 'user' && $pendaftaran->peserta->user_id !== $request->user()->getAuthIdentifier()
        ) {
            abort(403);
        }
        return view('pembayaran.show', compact('pendaftaran'));
    }

    public function index()
    {
        $pembayaran = Pembayaran::with([
            'pendaftaran.peserta.user',
            'pendaftaran.program',
            'detailPembayaran'
        ])->latest('created_at')->paginate(10);
        return view('pembayaran.index', compact('pembayaran'));
    }
}