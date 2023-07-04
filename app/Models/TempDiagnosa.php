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
        'jumlah_kecanduan',
        'gejala_terpenuhi'
    ];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'gejala');
    }

    public function userDiagnosa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
