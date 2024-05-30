<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;
    protected $fillable = [
        'ortu_id',
        'nama',
        'nama_panggilan',
        'nik',
        'anak_ke',
        'jenis_kelamin',
        'kota_lahir',
        'tanggal_lahir',
        'image_path',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'alamat',
    ];

    public function orang_tua(){
        return $this->hasOne(OrangTua::class,'id','ortu_id');
    }

    public function ppdb(){
        return $this->hasMany(Ppdb::class,'nik','nik');
    }
}
