<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahTahun extends Model
{
    use HasFactory;

    protected $table = 'sekolah_tahun';
    protected $primaryKey = 'id';

    protected $fillable = [
        'sekolah_id',
        'tahun_id',
        'jml_peserta_didik',
        'jml_guru',
        'jml_pegawai',
        'jml_rombel',
        'jml_kelas',         // Added
        'jml_lab',           // Added
        'jml_perpustakaan'   // Added
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'tahun_id');
    }
}
