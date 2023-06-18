<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    protected $table = 'gejala_kecanduan';

    protected $fillable = [
        'gejala_id', 'kecandua_id'
    ];
}
