<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id', 
        'status', 
        'nominal', 
        'nominal_terbayar', 
        'tanggal_bayar', 
        'gambar_faktur',
        'tempat_bayar',
        'teller',
    ];

    public function siswa(){
        return $this->hasOne(Siswa::class,'id','siswa_id');
    }

    public function siswa_kelas(){
        return $this->hasOneThrough(Kelas::class,Siswa::class,'id','id','siswa_id','kelas_id');
    }
}
