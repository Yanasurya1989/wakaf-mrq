@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm p-4">
            <h4 class="fw-bold text-success mb-3">
                👩‍🏫 Detail Kelas: {{ $kelas->nama }}
            </h4>

            <p class="text-muted mb-4">
                Total siswa: <strong>{{ $totalSiswa }}</strong> |
                Sudah menjadi pewakaf: <strong>{{ $totalPewakaf }}</strong>
            </p>

            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nama Siswa</th>
                        <th>Status Pewakaf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kelas->siswa as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->nama_siswa }}</td>
                            <td>
                                @if ($s->is_pewakaf)
                                    <span class="badge bg-success">✅ Pewakaf</span>
                                @else
                                    <span class="badge bg-secondary">Belum</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end mt-3">
                <a href="{{ url()->previous() }}" class="btn btn-outline-success rounded-pill">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
