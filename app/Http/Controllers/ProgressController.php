<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        // Ambil semua kelas beserta siswa
        $kelas = Kelas::with('siswa')->get();

        return view('progress.index', compact('kelas'));
    }
}
