<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganTahun extends Model
{
    use HasFactory;
    protected $table = 'ruangan_tahun'; // Custom table name

    protected $primaryKey = 'id';
    protected $fillable = ['sekolah_tahun_id', 'jenis_ruangan', 'jumlah'];

    public function sekolahTahun()
    {
        return $this->belongsTo(SekolahTahun::class, 'sekolah_tahun_id');
    }
}
