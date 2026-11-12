<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $data_program = Program::all();
        return view('program.index', compact('data_program'));
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'durasi' => 'required|string',
            'kuota' => 'required|integer|min:1',
            'dokumen' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $gambar = $request->file('gambar')->store('gambar-program', 'public');
        $program = new Program();
        $program->nama_program = $request->nama;
        $program->deskripsi = $request->deskripsi;
        $program->biaya = $request->biaya;
        $program->durasi = $request->durasi;
        $program->kuota = $request->kuota;
        $program->dokumen_wajib = $request->dokumen;
        $program->gambar = $gambar;
        $program->save();
        return redirect('home')->with('pesan','Data program berhasil disimpan');
    }

    public function destroy(string $id)
    {
        $program = Program::where('id_program', $id)->firstOrFail();
        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
        }
        $program->delete();
        return redirect('home')->with('pesan', 'Data program berhasil dihapus');
    }

    public function edit(string $id)
    {
        $program = Program::where('id_program', $id)->firstOrFail();

        return view('program.edit', compact('program'));
    }

    public function update(Request $request, string $id)
    {
        $program = Program::where('id_program', $id)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'durasi' => 'required|string|max:50',
            'kuota' => 'required|integer|min:1',
            'dokumen' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }

            $program->gambar = $request->file('gambar')->store('gambar-program', 'public');
        }
        $program->nama_program = $request->nama;
        $program->deskripsi = $request->deskripsi;
        $program->biaya = $request->biaya;
        $program->durasi = $request->durasi;
        $program->kuota = $request->kuota;
        $program->dokumen_wajib = $request->dokumen;
        $program->save();
        return redirect('home')->with('pesan', 'Data program berhasil diperbarui');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_program = Program::where('nama_program', 'like', '%' . $cari . '%')
        ->orWhere('deskripsi', 'like', '%' . $cari . '%')
        ->paginate($batas);
        $jumlah_program = $data_program->count();
        $no = $batas * ($data_program->currentPage() - 1);
        return view('program.search', compact('jumlah_program','data_program','no','cari'));
    }
}
    