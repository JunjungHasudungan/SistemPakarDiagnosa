<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GejalaKecanduan extends Model
{
    use HasFactory;

    protected $table = 'gejala_kecanduan';

    protected $fillable = [
        'gejala_id', 'kecanduan_id'
    ];
}
