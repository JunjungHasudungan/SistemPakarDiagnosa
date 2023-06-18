<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function KecanduanGejala()
    {
        return $this->belongsToMany(Kecanduan::class, 'gejala_kecanduan', 'gejala_id', 'kecanduan_id');
    }
}
