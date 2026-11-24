<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $data_program = Program::orderBy('nama_program')->get();
        return view('program.index', compact('data_program'));
    }

    public function create()
    {
        return view('program.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'durasi' => 'required|string|max:50',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $gambar = $request->file('gambar')->store('gambar-program', 'public');
        Program::create([
            'nama_program' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'biaya' => $validated['biaya'],
            'durasi' => $validated['durasi'],
            'kuota' => $validated['kuota'],
            'gambar' => $gambar,
        ]);
        return redirect('home')->with('pesan', 'Data program berhasil disimpan');
    }

    public function edit(string $id)
    {
        $program = Program::findOrFail($id);
        return view('program.edit', compact('program'));
    }

    public function update(Request $request, string $id)
    {
        $program = Program::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'durasi' => 'required|string|max:50',
            'kuota' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($program->gambar) {
                Storage::disk('public')->delete($program->gambar);
            }
            $program->gambar = $request->file('gambar')
                ->store('gambar-program', 'public');
        }
        $program->nama_program = $validated['nama'];
        $program->deskripsi = $validated['deskripsi'];
        $program->biaya = $validated['biaya'];
        $program->durasi = $validated['durasi'];
        $program->kuota = $validated['kuota'];
        $program->save();
        return redirect('home')->with('pesan', 'Data program berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        if ($program->gambar) {
            Storage::disk('public')->delete($program->gambar);
        }
        $program->delete();
        return redirect('home')->with('pesan', 'Data program berhasil dihapus');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_program = Program::where('nama_program', 'like', '%' . $cari . '%')
            ->orWhere('deskripsi', 'like', '%' . $cari . '%')
            ->paginate($batas)
            ->withQueryString();
        $jumlah_program = $data_program->total();
        $no = $batas * ($data_program->currentPage() - 1);
        return view('program.search', compact('jumlah_program', 'data_program', 'no', 'cari'));
    }
}