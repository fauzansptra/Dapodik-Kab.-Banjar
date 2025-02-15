<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $table = 'tahun';
    protected $primaryKey = 'id';

    protected $fillable = ['tahun'];

    public function sekolahTahun()
    {
        return $this->hasMany(SekolahTahun::class, 'tahun_id');
    }
}
