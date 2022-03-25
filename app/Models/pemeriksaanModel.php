<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemeriksaanModel extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan';
    protected $guarded = ['id_pemeriksaan'];
   
    public $timestamps = false;
    
    public function resepModel()
    {
        return $this->hasMany(resepModel::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }

    public function rmModel()
    {
        return $this->belongsTo(rmModel::class, 'id_pemeriksaan', 'id_pemeriksaan');
    }

    public function usersModel()
    {
        return $this->hasMany(usersModel::class, 'id');
    }

    public function pasienModel()
    {
        return $this->belongsTo(pasienModel::class, 'id_pasien');
    }

    public function diagnosaModel()
    {
        return $this->belongsTo(diagnosaModel::class, 'id_diagnosa', 'id');
    }
}
