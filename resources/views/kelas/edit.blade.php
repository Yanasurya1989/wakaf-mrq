@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Kelas</h3>

        <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama" value="{{ $kela->nama }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
