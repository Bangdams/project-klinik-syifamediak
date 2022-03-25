<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pemeriksaanModel()
    {
        return $this->hasMany(pemeriksaanModel::class);
    }
}
