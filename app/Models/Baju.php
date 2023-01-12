<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
    use HasFactory;

    protected $table = 'baju';
    protected $guarded = [];

    // Relasi ke Penerbit
    public function pendiri()
    {
        return $this->belongsTo(Pendiri::class, 'pendiri_id', 'id');
    }
}
