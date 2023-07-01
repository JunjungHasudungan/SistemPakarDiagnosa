<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    public $guarded = [];

    public function kecanduanDiagnosa()
    {
        return $this->belongsToMany(Kecanduan::class, 'diagnosa_kecanduan', 'diagnosa_id', 'kecanduan_id')->withPivot('gejala_id');
    }
}
