<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function index($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $setoran = Setoran::where('siswa_id', $siswa_id)->orderBy('tanggal', 'desc')->get();

        return view('setoran.index', compact('siswa', 'setoran'));
    }

    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('setoran.create', compact('siswa'));
    }

    public function store(Request $request, $siswa_id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:1000',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Setoran::create([
            'siswa_id' => $siswa_id,
            'tanggal' => $request->tanggal,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('setoran.index', $siswa_id)
            ->with('success', 'Setoran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $setoran = Setoran::findOrFail($id);
        $siswa = $setoran->siswa;
        return view('setoran.edit', compact('setoran', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:1000',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $setoran = Setoran::findOrFail($id);
        $setoran->update($request->only(['tanggal', 'nominal', 'keterangan']));

        return redirect()->route('setoran.index', $setoran->siswa_id)
            ->with('success', 'Setoran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $setoran = Setoran::findOrFail($id);
        $siswa_id = $setoran->siswa_id;
        $setoran->delete();

        return redirect()->route('setoran.index', $siswa_id)
            ->with('success', 'Setoran berhasil dihapus.');
    }
}
