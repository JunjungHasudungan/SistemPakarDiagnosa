<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class);
    }
}
