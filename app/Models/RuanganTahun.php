<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganTahun extends Model
{
    use HasFactory;
    protected $table = 'ruangan_tahun'; // Custom table name

    protected $primaryKey = 'id';
    protected $fillable = ['sekolah_id', 'jenis_ruangan', 'jumlah','tahun_id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
    
    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'tahun_id');
    }
}
