<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah'; // Custom table name

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'bentuk_pendidikan',
        'status',
        'last_sync',
        'jml_sync',
        'kecamatan_id'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function sekolahTahun()
    {
        return $this->hasMany(SekolahTahun::class, 'sekolah_id');
    }
    public function ruanganTahun()
    {
        return $this->hasMany(RuanganTahun::class, 'sekolah_id');
    }
}
