<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'is_pewakaf' => 'nullable|boolean',
        ]);

        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'is_pewakaf' => $request->has('is_pewakaf'),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'is_pewakaf' => 'nullable|boolean',
        ]);

        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'kelas_id' => $request->kelas_id,
            'is_pewakaf' => $request->boolean('is_pewakaf'),
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa dihapus.');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Download template Excel langsung tanpa halaman tambahan
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'nama_siswa');
        $sheet->setCellValue('B1', 'nama_kelas');
        $sheet->setCellValue('C1', 'is_pewakaf');

        // Contoh data
        $sheet->setCellValue('A2', 'Ahmad');
        $sheet->setCellValue('B2', '7 Ibnu Sina');
        $sheet->setCellValue('C2', 'ya');

        $sheet->setCellValue('A3', 'Budi');
        $sheet->setCellValue('B3', '7 Ibnu Rusydi');
        $sheet->setCellValue('C3', 'tidak');

        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        // Kirim file sebagai stream ke browser
        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="template_import_siswa.xlsx"',
        ]);
    }

    /**
     * Import data dari file CSV/XLSX
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx|max:2048',
        ]);

        $file = $request->file('file');

        $handle = fopen($file, 'r');
        fgetcsv($handle); // lewati header

        $count = 0;
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $namaSiswa = $data[0] ?? null;
            $namaKelas = $data[1] ?? null;
            $isPewakaf = isset($data[2]) && strtolower(trim($data[2])) == 'ya' ? 1 : 0;

            if (!$namaSiswa || !$namaKelas) continue;

            $kelas = Kelas::firstOrCreate(['nama' => $namaKelas]);

            Siswa::create([
                'nama_siswa' => $namaSiswa,
                'kelas_id' => $kelas->id,
                'is_pewakaf' => $isPewakaf,
            ]);

            $count++;
        }

        fclose($handle);

        return redirect()->route('siswa.index')->with('success', "$count siswa berhasil diimport.");
    }

    public function pewakaf()
    {
        // Ambil hanya siswa yang sudah menjadi pewakaf
        $siswa = \App\Models\Siswa::where('is_pewakaf', true)->with('kelas')->get();

        // dd($siswa);
        return view('siswa.pewakaf', compact('siswa'));
    }

    public function riwayat($id)
    {
        $siswa = \App\Models\Siswa::with('kelas')->findOrFail($id);
        $riwayat = \App\Models\Setoran::where('siswa_id', $id)->orderBy('tanggal', 'desc')->get();

        return view('siswa.riwayat', compact('siswa', 'riwayat'));
    }
}
