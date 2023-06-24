<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;

    protected $table = 'solusis';

    protected $fillable = [
        'keterangan'
    ];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class, 'kecanduan_id');
    }

    public function kecanduanSolusi()
    {
        return $this->belongsToMany(Kecanduan::class, 'kecanduan_solusi', 'solusi_id', 'kecanduan_id')->withPivot('role');
    }

}
