@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Tambah Kelas</h3>

        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kelas</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
