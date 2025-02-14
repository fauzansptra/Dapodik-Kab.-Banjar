<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganTahun extends Model
{
    use HasFactory;

    protected $primaryKey = 'RuanganTahunID';
    protected $fillable = ['SekolahTahunID', 'JenisRuangan', 'Jumlah'];

    public function sekolahTahun()
    {
        return $this->belongsTo(SekolahTahun::class, 'SekolahTahunID');
    }
}
