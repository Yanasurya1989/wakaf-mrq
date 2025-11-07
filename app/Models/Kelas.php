<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Total siswa per kelas
    public function getTotalSiswaAttribute()
    {
        return $this->siswa()->count();
    }

    // Jumlah siswa yang pewakaf
    public function getTotalPewakafAttribute()
    {
        return $this->siswa()->where('is_pewakaf', true)->count();
    }

    // Persentase pewakaf
    public function getPersentaseAttribute()
    {
        return $this->total_siswa > 0
            ? round(($this->total_pewakaf / $this->total_siswa) * 100)
            : 0;
    }
}
