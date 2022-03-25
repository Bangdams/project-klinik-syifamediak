<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailResep extends Model
{
    use HasFactory;
    protected $table = 'detail_resep';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function obatModel()
    {
        return $this->belongsTo(obatModel::class, 'id_obat');
    }
}
