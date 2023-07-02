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
        return $this->belongsToMany(Solusi::class, 'kecanduan_solusi', 'solusi_id' , 'kecanduan_id')->withPivot('role')->withTimestamps();
    }

    public function gejalaKecanduan()
    {
        return $this->belongsToMany(Gejala::class, 'gejala_kecanduan', 'kecanduan_id', 'gejala_id')->withPivot('keterangan_relasi')->withTimestamps();
    }

    public function attachGejala($id_gejala)
    {
        $gejala = Gejala::find($id_gejala);

        return $this->gejalaKecanduan()->attach($gejala);
    }

    public function diagnosaKecanduan()
    {
        return $this->belongsToMany(Diagnosa::class, 'diagnosa_kecanduan', 'diagnosa_id', 'kecanduan_id')->withPivot('gejala_id');
    }

    public function diagnosas()
    {
        return $this->hasMany(TempDiagnosa::class, 'kecanduan_id');
    }
}
