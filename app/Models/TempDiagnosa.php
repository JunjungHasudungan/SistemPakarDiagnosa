<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempDiagnosa extends Model
{
    use HasFactory;

    protected $table = 'temp_diagnosa';

    protected $fillable = [
        'user_id',
        'kecanduan_id',
        'gejala',
        'gejala_terpenuhi'
    ];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class, 'kecanduan_id');
    }
}
