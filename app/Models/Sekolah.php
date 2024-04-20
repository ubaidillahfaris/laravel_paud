<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'provinsi_id',
        'kota_id',
        'kecamatan',
        'desa',
        'image',
        'kontak',
        'akreditasi',
        'lat',
        'long',
        'data',
    ];

    public function provinsi(){
        return $this->hasOne(Provinsi::class,'id','provinsi_id');
    }

    public function kota(){
        return $this->hasOne(Kota::class,'id','kota_id');
    }

    public function kecamatan(){
        return $this->hasOne(Kecamatan::class,'id','kecamatan');
    }

    public function desa(){
        return $this->hasOne(Desa::class,'id','desa');
    }
}
