<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kelas_id',
        'nama_lengkap',
        'nama_panggilan',
        'nik',
        'anak_ke',
        'jenis_kelamin',
        'kota_lahir',
        'tanggal_lahir',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_hp_ibu',
        'foto',
        'provinsi',
        'kota_kab',
        'kecamatan',
        'kelurahan',
        'alamat',
    ];

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }
}
