<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahTahun extends Model
{
    use HasFactory;

    protected $primaryKey = 'SekolahTahunID';
    protected $fillable = [
        'SekolahID',
        'Tahun',
        'JumlahPesertaDidik',
        'JumlahGuru',
        'JumlahPegawai',
        'JumlahRombel'
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'SekolahID');
    }

    public function ruangans()
    {
        return $this->hasMany(RuanganTahun::class, 'SekolahTahunID');
    }
}
