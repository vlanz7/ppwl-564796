<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'level' => 'admin',
        ]);
        return redirect()->route('pendaftaran.index')
            ->with('pesan', 'Akun Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('level', 'admin')->findOrFail($id);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        if (!empty($validated['password'])) {
            $admin->password = $validated['password'];
        }
        $admin->save();
        return redirect()->route('pendaftaran.index')
            ->with('pesan', 'Data Admin berhasil diperbarui.');
    }

    public function destroy(Request $request, $id)
    {
        $admin = User::where('level', 'admin')->findOrFail($id);
        if ($admin->id == $request->user()->id) {
            return redirect()->route('pendaftaran.index')
                ->with('pesan', 'Anda tidak dapat menghapus akun sendiri.');
        }
        if (User::where('level', 'admin')->count() <= 1) {
            return redirect()->route('pendaftaran.index')
                ->with('pesan', 'Minimal harus ada satu akun Admin.');
        }
        $admin->delete();
        return redirect()->route('pendaftaran.index')
            ->with('pesan', 'Akun Admin berhasil dihapus.');
    }
}
