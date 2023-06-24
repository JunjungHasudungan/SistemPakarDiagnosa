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
        return $this->belongsToMany(Kecanduan::class, 'gejala_kecanduan', 'kecanduan_id', 'gejala_id');
    }

    public function gejalaKecanduan()
    {
        return $this->belongsToMany(GejalaKecanduan::class, 'gejala_kecanduan', 'kecanduan_id', 'gejala_id');
    }
}
