<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendiri extends Model
{
    use HasFactory;

    protected $table = 'pendiri';
    protected $guarded = [];

    // Relasi ke Baju
    public function baju()
    {
        return $this->hasOne(Baju::class, 'pendiri_id', 'id');
    }
}
