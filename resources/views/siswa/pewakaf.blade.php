@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap text-center text-md-start">
            <h3 class="mb-3 mb-md-0">💚 Daftar Siswa Pewakaf</h3>
            <a href="{{ route('siswa.index') }}" class="btn btn-outline-secondary shadow-sm">⬅ Kembali ke Daftar Siswa</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                @if ($siswa->count() > 0)
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-success text-center">
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                @php
                                    // Nomor WhatsApp siswa (ubah sesuai field database kamu)
                                    $no_hp = $s->no_hp ?? '6281234567890';

                                    // Pesan WhatsApp berisi ajakan + flyer
                                    $pesan = "🌿 Assalamu’alaikum, {$s->nama_siswa}!%0A%0ATerima kasih sudah menjadi bagian dari para *pewakaf cilik* di kelas {$s->kelas->nama} 💚.%0A%0ASemoga amal jariyahmu terus mengalir tanpa henti. Yuk bagikan semangat wakaf ini ke teman-teman lainnya!%0A%0A📎 Lihat flyer kegiatan kami di sini:%0Ahttps://contoh-link-flyer.com/flyer-wakaf.jpg%0A%0A#WakafBerkah #SekolahWakaf";
                                @endphp

                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama_siswa }}</td>
                                    <td>{{ $s->kelas->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="https://wa.me/{{ $no_hp }}?text={{ $pesan }}" target="_blank"
                                            class="btn btn-success btn-sm">
                                            📩 Kirim WA
                                        </a>

                                        <a href="{{ route('siswa.riwayat', $s->id) }}" class="btn btn-warning btn-sm">
                                            💰 Riwayat Setoran
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning text-center mb-0">
                        Belum ada siswa yang menjadi pewakaf.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
