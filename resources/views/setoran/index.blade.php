@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap text-center text-md-start">
            <h3>💰 Riwayat Setoran — {{ $siswa->nama_siswa }}</h3>
            <a href="{{ route('siswa.pewakaf') }}" class="btn btn-outline-secondary shadow-sm">⬅ Kembali</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex gap-2 mb-3 flex-wrap">
            <a href="{{ route('setoran.create', $siswa->id) }}" class="btn btn-success">
                + Tambah Setoran
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($setoran->count() > 0)
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-warning text-center">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Pesan WA</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($setoran as $r)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                                    <td class="text-end">Rp {{ number_format($r->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $r->keterangan ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($r->tanggal)->format('d M Y');
                                            $nominal = number_format($r->nominal, 0, ',', '.');
                                            $pesan = "Terima kasih sudah berwakaf pada tanggal $tanggal sebesar Rp $nominal. Semoga Allah membalas dengan kebaikan yang berlipat ganda 🤲";
                                            $pesanEncode = urlencode($pesan);
                                            $nomorTujuan = $siswa->no_hp ?? '6281234567890';
                                        @endphp

                                        <a href="https://wa.me/{{ $nomorTujuan }}?text={{ $pesanEncode }}" target="_blank"
                                            class="btn btn-success btn-sm shadow-sm">
                                            📱 Kirim WA
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('setoran.edit', $r->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('setoran.destroy', $r->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus setoran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
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
