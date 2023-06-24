<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPakar extends Model
{
    use HasFactory;

    protected $table = 'data_pakar';

    protected $fillable = [
        'gejala_id', 'kecanduan_id'
    ];

    public function gejalaKecanduan()
    {
        return $this->belongsToMany(Kecanduan::class, 'gejala_kecanduan', 'gejala_id', 'kecanduan_id')->withTimestamps();
    }
}
