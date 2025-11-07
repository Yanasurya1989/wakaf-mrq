@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Detail Siswa</h3>
        <p><strong>Nama:</strong> {{ $siswa->nama_siswa }}</p>
        <p><strong>Kelas:</strong> {{ $siswa->kelas->nama }}</p>
        <p><strong>Pewakaf:</strong> {{ $siswa->is_pewakaf ? 'Ya' : 'Belum' }}</p>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
