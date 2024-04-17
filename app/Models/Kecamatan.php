<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'reg_districts';

    protected $fillable = [
        'regency_id',
        'name',
    ];

    public function kota(){
        return $this->belongsTo(Kota::class,'id','regency_id');
    }

    public function desa(){
        return $this->hasMany(Desa::class,'district_id','id');
    }
}
