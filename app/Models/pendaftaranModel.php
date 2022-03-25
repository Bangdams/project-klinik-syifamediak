<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaranModel extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pasienModel()
    {
        return $this->belongsTo(pasienModel::class, 'id_pasien', 'id');
    }
}
