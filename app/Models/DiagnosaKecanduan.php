<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosaKecanduan extends Model
{
    use HasFactory;

    protected $table = 'diagnosa_kecanduan';

    protected $fillable = [
        'diagnosa_id', 'kecanduan_id', 'gejala_id'
    ];
}
