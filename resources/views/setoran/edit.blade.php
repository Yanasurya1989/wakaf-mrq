@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>✏️ Edit Setoran — {{ $siswa->nama_siswa }}</h3>
        <a href="{{ route('setoran.index', $siswa->id) }}" class="btn btn-outline-secondary mb-3">⬅ Kembali</a>

        <form action="{{ route('setoran.update', $setoran->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $setoran->tanggal }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nominal (Rp)</label>
                <input type="number" name="nominal" class="form-control" value="{{ $setoran->nominal }}" min="1000"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $setoran->keterangan }}">
            </div>
            <button type="submit" class="btn btn-warning">💾 Update</button>
        </form>
    </div>
@endsection
