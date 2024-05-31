<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunPelajaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sekolah_id','start_tahun','end_tahun','semester','id_kota_pembagian_raport','tanggal_pembagian_raport','is_active','created_by'
    ];

    public function kota_pembagian(){
        return $this->hasOne(Kota::class,'id','id_kota_pembagian_raport');
    }
}
