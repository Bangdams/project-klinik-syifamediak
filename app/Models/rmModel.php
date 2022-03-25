<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rmModel extends Model
{
    use HasFactory;
    protected $table = 'rekam_medis';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pemeriksaanModel()
    {
        return $this->belongsTo(pemeriksaanModel::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }

    public function pasienModel()
    {
        return $this->belongsTo(pasienModel::class, 'id_pasien');
    }
}
