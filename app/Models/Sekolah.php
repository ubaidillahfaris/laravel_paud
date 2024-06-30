<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sekolah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'provinsi_id',
        'kota_id',
        'kecamatan',
        'desa',
        'alamat',
        'image',
        'kontak',
        'akreditasi',
        'lat',
        'long',
        'data',
    ];

    protected $appends = ['foto_url'];

    public function getFotoUrlAttribute()
    {
        return url(
            Storage::url($this->attributes['image'])
        );
    }

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

    public function adminSekolah(){
        return $this->hasMany(AdminSekolah::class,'sekolah_id','id');
    }

    public function kurikulum(){
        return $this->hasOneThrough(Kurikulum::class,KurikulumSekolah::class,'sekolah_id','id','kurikulum_id','id');
    }
}
