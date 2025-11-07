@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap text-center text-md-start">
            <h3 class="mb-3 mb-md-0">💰 Riwayat Setoran — {{ $siswa->nama_siswa }}</h3>
            <a href="{{ route('siswa.pewakaf') }}" class="btn btn-outline-secondary shadow-sm">⬅ Kembali</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($riwayat->count() > 0)
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-warning text-center">
                            <tr>
                                <th width="5%">#</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $r)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                    <td class="text-end">Rp {{ number_format($r->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $r->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info text-center mb-0">
                        Belum ada riwayat setoran untuk siswa ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
