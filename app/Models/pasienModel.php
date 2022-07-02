<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasienModel extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $guarded = [
        'id',
    ];
    public $timestamps = false;

    public function pemeriksaanModel()
    {
        return $this->hasMany(pemeriksaanModel::class, 'id_pasien','id');
    }

    public function rmModel()
    {
        return $this->hasMany(rmModel::class, 'id');
    }

    public function pendaftaranModel()
    {
        return $this->hasMany(pendaftaranModel::class, 'id_pasien');
    }

}
