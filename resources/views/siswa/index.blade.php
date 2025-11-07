@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>👨‍🎓 Daftar Siswa</h3>
        <a href="{{ route('siswa.create') }}" class="btn btn-success mb-3">+ Tambah Siswa</a>
        <a href="{{ route('siswa.pewakaf') }}" class="btn btn-outline-success mb-3">
            💚 Lihat Siswa Pewakaf
        </a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Siswa</h3>
            <a href="{{ route('siswa.template') }}" class="btn btn-success mb-3">
                📥 Download Template Excel
            </a>

        </div>

        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control" accept=".csv,.xlsx" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload"></i> Import Siswa
                    </button>
                </div>
            </div>
            <small class="text-muted">
                Format: nama_siswa, nama_kelas, is_pewakaf (isi “ya” atau “tidak”)
            </small>
        </form>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Pewakaf?</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nama_siswa }}</td>
                        <td>{{ $s->kelas->nama ?? '-' }}</td>
                        <td>
                            @if ($s->is_pewakaf)
                                <span class="badge bg-success">Ya</span>
                            @else
                                <span class="badge bg-secondary">Belum</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin hapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
