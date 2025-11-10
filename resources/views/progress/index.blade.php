<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Progress Wakaf Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .progress {
            height: 25px;
            border-radius: 50px;
            background-color: #e9ecef;
            position: relative;
        }

        .bg-success-bar {
            background: linear-gradient(90deg, #4ade80, #22c55e);
            transition: width 0.8s ease;
        }

        .bg-gold {
            background: linear-gradient(90deg, #facc15, #f59e0b);
        }

        .runner {
            position: absolute;
            top: -8px;
            font-size: 25px;
            transform: translateX(-50%) scaleX(-1);
            transition: left 0.8s ease;
        }

        .title {
            font-weight: 700;
            color: #198754;
        }

        .subtext {
            color: #6c757d;
        }

        .btn-detail {
            background-color: #198754;
            color: #fff;
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-detail:hover {
            background-color: #157347;
            color: #fff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2 class="title">📊 Progress Pewakaf per Kelas</h2>
            <p class="subtext">Berapa persen siswa di tiap kelas sudah menjadi pewakaf</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    @foreach ($kelas as $k)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1 flex-wrap">
                                <h5 class="mb-0">{{ $k->nama }}</h5>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="text-muted">
                                        {{ $k->total_pewakaf }} / {{ $k->total_siswa }} siswa
                                    </small>
                                    <a href="{{ route('kelas.show', $k->id) }}" class="btn btn-detail">
                                        <i class="bi bi-people-fill me-1"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>

                            <div class="progress mt-2">
                                @if ($k->persentase == 0)
                                    <div class="progress-bar bg-danger text-white fw-bold" style="width: 100%;">
                                        Semangat 💪
                                    </div>
                                @elseif ($k->persentase == 100)
                                    <div class="progress-bar bg-gold text-dark fw-bold" style="width: 100%;">
                                        GREAT ✅
                                    </div>
                                @else
                                    <div class="progress-bar bg-success-bar" role="progressbar"
                                        style="width: {{ $k->persentase }}%;" aria-valuenow="{{ $k->persentase }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <span class="runner" style="left: calc({{ $k->persentase }}% - 12px);">
                                        🏃‍♂️
                                    </span>
                                @endif
                            </div>

                            <div class="text-end mt-1">
                                <small class="text-muted">{{ $k->persentase }}%</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
