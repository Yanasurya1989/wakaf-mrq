<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Tambahkan baris ini 👇
    protected $table = 'siswa';

    protected $fillable = ['nama_siswa', 'kelas_id', 'is_pewakaf'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class);
    }
}
