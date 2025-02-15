<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $table = 'tahuns';
    protected $primaryKey = 'TahunID';

    protected $fillable = ['Tahun'];

    public function sekolahTahun()
    {
        return $this->hasMany(SekolahTahun::class, 'TahunID', 'TahunID');
    }
}
