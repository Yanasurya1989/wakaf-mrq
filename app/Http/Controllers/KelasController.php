<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kelas::create($request->only('nama'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kela->update($request->only('nama'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function show($id)
    {
        $kelas = Kelas::with('siswa')->findOrFail($id);

        $totalSiswa = $kelas->siswa->count();
        $totalPewakaf = $kelas->siswa->where('is_pewakaf', true)->count();

        return view('kelas-detail', compact('kelas', 'totalSiswa', 'totalPewakaf'));
    }
}
