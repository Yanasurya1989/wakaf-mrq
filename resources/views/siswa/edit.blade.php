@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Siswa</h3>

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Siswa</label>
                <input type="text" name="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="kelas_id" class="form-select" required>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-check mb-3">
                <input type="hidden" name="is_pewakaf" value="0">
                <input type="checkbox" name="is_pewakaf" class="form-check-input" id="pewakaf" value="1"
                    {{ $siswa->is_pewakaf ? 'checked' : '' }}>
                <label class="form-check-label" for="pewakaf">Sudah menjadi Pewakaf?</label>
            </div>

            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
