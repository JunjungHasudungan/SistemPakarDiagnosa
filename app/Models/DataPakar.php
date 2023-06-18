<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPakar extends Model
{
    use HasFactory;

    protected $table = 'gejala_kecanduan';

    protected $fillable = [
        'gejala_id', 'kecanduan_id'
    ];

    public function gejalaKecanduan()
    {
        $this->belongsToMany(GejalaKecanduan::class, 'gejala_kecanduan', 'gejala_id', 'kecanduan_id');
    }
}
