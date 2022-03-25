<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obatModel extends Model
{
    use HasFactory;
    protected $table = 'obat';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function resepModel()
    {
        return $this->hasMany(resepModel::class, 'id', 'id');
    }
}
