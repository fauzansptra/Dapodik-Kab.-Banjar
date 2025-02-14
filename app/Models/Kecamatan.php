<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan'; // Custom table name

    protected $primaryKey = 'KecamatanID';
    protected $fillable = ['NamaKecamatan'];

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'KecamatanID');
    }
}
