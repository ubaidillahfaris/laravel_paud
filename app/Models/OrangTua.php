<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrangTua extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_ayah',
        'no_ibu',
        'email_ayah',
        'email_ibu',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
    ];

    public function anak(){
        return $this->hasMany(Anak::class,'ortu_id','id');
    }
}
