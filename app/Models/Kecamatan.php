<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'KecamatanID';
    protected $fillable = ['NamaKecamatan'];

    public function sekolahs()
    {
        return $this->hasMany(Sekolah::class, 'KecamatanID');
    }
}
