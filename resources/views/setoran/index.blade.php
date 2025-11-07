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

            @php
                // Pastikan nomor WA siswa disimpan di kolom 'no_hp' di tabel siswa
                $no_hp = isset($siswa->no_hp) ? preg_replace('/^0/', '62', $siswa->no_hp) : null;

                $pesan = "Assalamu'alaikum, *{$siswa->nama_siswa}* 🙏%0A%0ATerima kasih atas wakaf yang telah diberikan. Wakaf Anda telah kami terima dengan baik.%0A%0ASemoga Allah membalas dengan pahala berlipat ganda, memberi keberkahan dalam hidup, serta melimpahkan rahmat dan rezeki yang luas.🤲💚%0A%0A_Jazakallah khairan katsiran._";
            @endphp

            @if ($no_hp)
                <a href="https://wa.me/{{ $no_hp }}?text={{ $pesan }}" target="_blank"
                    class="btn btn-success shadow-sm">
                    📲 Kirim Ucapan Terima Kasih via WhatsApp
                </a>
            @else
                <button class="btn btn-secondary" disabled>
                    📵 Nomor WA belum tersedia
                </button>
            @endif
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
