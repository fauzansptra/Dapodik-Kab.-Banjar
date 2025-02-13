<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $primaryKey = 'SekolahID';
    protected $fillable = [
        'NamaSekolah',
        'NPSN',
        'BentukPendidikan',
        'Status',
        'LastSync',
        'JmlSync',
        'KecamatanID',
        'TahunAjaran',
        'Semester',
        'JumlahPesertaDidik',
        'JumlahGuru',
        'JumlahPegawai',
        'JumlahRombel'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'KecamatanID');
    }

    public function ruangans()
    {
        return $this->hasMany(Ruangan::class, 'SekolahID');
    }
}
