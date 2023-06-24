<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function kecanduans()
    {
        return $this->belongsTo(Kecanduan::class, 'kecanduan_id');
    }

    public function kecanduan()
    {
        return $this->belongsToMany(Kecanduan::class, 'gejala_kecanduan', 'kecanduan_id', 'gejala_id')->withPivot('keterangan_relasi');
    }

}
