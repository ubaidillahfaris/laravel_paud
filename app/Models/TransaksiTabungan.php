<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTabungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_ajaran_id',
        'siswa_id',
        'jenis',
        'mutasi_masuk',
        'mutasi_keluar',
        'tanggal_transaksi',
        'keterangan'
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id','id');
    }
}
