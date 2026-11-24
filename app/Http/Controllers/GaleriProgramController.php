<?php

namespace App\Http\Controllers;

use App\Models\GaleriProgram;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriProgramController extends Controller
{
    public function index()
    {
        $galeri = GaleriProgram::with('program')
            ->latest()
            ->paginate(10);
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        $program = Program::orderBy('nama_program')->get();
        return view('galeri.create', compact('program'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_program' => 'required|exists:program,id_program',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $foto = $request->file('foto')
            ->store('galeri_program', 'public');
        GaleriProgram::create([
            'id_program' => $request->id_program,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
        ]);
        return redirect()->route('galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galeri = GaleriProgram::findOrFail($id);
        $program = Program::orderBy('nama_program')->get();
        return view('galeri.edit', compact('galeri', 'program'));
    }

    public function update(Request $request, $id)
    {
        $galeri = GaleriProgram::findOrFail($id);
        $request->validate([
            'id_program' => 'required|exists:program,id_program',
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $fotoLama = $galeri->foto;
        $galeri->id_program = $request->id_program;
        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        if ($request->hasFile('foto')) {
            $galeri->foto = $request->file('foto')
                ->store('galeri_program', 'public');
        }
        $galeri->save();
        if ($request->hasFile('foto') && $fotoLama) {
            Storage::disk('public')->delete($fotoLama);
        }
        return redirect()->route('galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = GaleriProgram::findOrFail($id);
        $foto = $galeri->foto;
        $galeri->delete();
        if ($foto) {
            Storage::disk('public')->delete($foto);
        }
        return redirect()->route('galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
}