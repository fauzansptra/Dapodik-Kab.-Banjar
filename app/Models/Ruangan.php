<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'RuanganID';
    protected $fillable = ['SekolahID', 'Jenis', 'Jumlah'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'SekolahID');
    }
}
