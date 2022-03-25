<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diagnosaModel extends Model
{
    use HasFactory;
    protected $table = 'diagnosa';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pemeriksaanModel()
    {
        return $this->hasMany(pemeriksaanModel::class, 'id');
    }
}
