@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">➕ Tambah Siswa / Import Data Siswa</h3>

        {{-- Notifikasi sukses / error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM TAMBAH SISWA --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white fw-bold">
                Form Tambah Siswa
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_siswa" class="form-label">Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_pewakaf" id="is_pewakaf" value="1">
                        <label class="form-check-label" for="is_pewakaf">
                            Merupakan Pewakaf
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Siswa
                    </button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">⬅ Kembali</a>
                </form>
            </div>
        </div>

        {{-- FORM IMPORT SISWA --}}
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white fw-bold">
                Import Data Siswa dari Excel / CSV
            </div>
            <div class="card-body">
                <p>Unduh terlebih dahulu format template berikut sebelum melakukan import:</p>
                <a href="{{ route('siswa.template') }}" class="btn btn-success mb-3">
                    📥 Download Template Excel
                </a>

                <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih File Excel/CSV</label>
                        <input type="file" name="file" id="file" class="form-control" accept=".csv,.xlsx"
                            required>
                    </div>

                    <button type="submit" class="btn btn-success">
                        📤 Import Data
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
