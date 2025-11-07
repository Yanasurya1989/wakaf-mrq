@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>➕ Tambah Setoran — {{ $siswa->nama_siswa }}</h3>
        <a href="{{ route('setoran.index', $siswa->id) }}" class="btn btn-outline-secondary mb-3">⬅ Kembali</a>

        <form action="{{ route('setoran.store', $siswa->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nominal (Rp)</label>
                <input type="number" name="nominal" class="form-control" min="1000" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Setoran minggu ke-1">
            </div>
            <button type="submit" class="btn btn-success">💾 Simpan</button>
        </form>
    </div>
@endsection
