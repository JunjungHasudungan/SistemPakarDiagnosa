<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\LevelKecanduan;

class Kecanduan extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solusi::class);
    }

    public function solusiKecanduan()
    {
        return $this->belongsToMany(Solusi::class, 'kecanduan_solusi', 'kecanduan_id', 'solusi_id')->withPivot('role');
    }

    public function gejalaKecanduan()
    {
        return $this->belongsToMany(Gejala::class, 'gejala_kecanduan', 'gejala_id', 'kecanduan_id');
    }

}
