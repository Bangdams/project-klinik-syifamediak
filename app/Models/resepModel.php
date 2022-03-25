<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resepModel extends Model
{
    use HasFactory;
    protected $table = 'resep';
    protected $guarded = ['no_resep'];
    public $timestamps = false;

    public function obatModel()
    {
        return $this->belongsTo(obatModel::class, 'id', 'id');
    }

    public function pemeriksaanModel()
    {
        return $this->belongsTo(pemeriksaanModel::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }
}
