<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Kelas & Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">🌿 Wakaf MRQ</a>
            <div>
                <a href="{{ route('kelas.index') }}" class="btn btn-light btn-sm me-2">Kelas</a>
                <a href="{{ route('siswa.index') }}" class="btn btn-light btn-sm me-2">Siswa</a>
                <a href="{{ route('progress.index') }}" class="btn btn-warning btn-sm">Progress</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>
</body>

</html>
