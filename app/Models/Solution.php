<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'kecanduan_id', 'keterangan', 'to_role', 'from_role'
    // ];
    protected $guraded = [];

    public function kecanduan()
    {
        return $this->belongsTo(Kecanduan::class, 'kecanduan_id');
    }

    public function kecanduanSolusi()
    {
        return $this->belongsToMany(Kecanduan::class, 'kecanduan_solusi')->withPivot('role');
    }
}
