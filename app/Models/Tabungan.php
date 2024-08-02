<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'tahun_ajaran_id',
        'siswa_id',
        'nominal_masuk',
        'nominal_keluar',
        'total',
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id','id');
    }

}
