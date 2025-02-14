<?php

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
        'KecamatanID'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'KecamatanID');
    }

    public function sekolahTahun()
    {
        return $this->hasMany(SekolahTahun::class, 'SekolahID');
    }
}
