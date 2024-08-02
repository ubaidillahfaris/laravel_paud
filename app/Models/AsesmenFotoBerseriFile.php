<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenFotoBerseriFile extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'asesmen_foto_id',
        'foto',
        'deskripsi',
    ];

    public function asesmen(){
        return $this->belongsTo(AsesmenFotoBerseri::class,'asesmen_foto_id','id');
    }
}
