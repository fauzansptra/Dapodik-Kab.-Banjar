<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahTahun extends Model
{
    use HasFactory;
    protected $table = 'sekolah_tahun'; // Custom table name


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

    public function ruangan()
    {
        return $this->hasMany(RuanganTahun::class, 'SekolahTahunID');
    }
}
