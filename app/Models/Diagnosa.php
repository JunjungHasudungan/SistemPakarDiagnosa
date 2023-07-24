<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    public $guarded = [];

    public function kecanduan()
    {
        return $this->hasMany(Kecanduan::class);
    }
}
