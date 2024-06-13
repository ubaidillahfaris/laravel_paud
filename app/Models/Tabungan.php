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
}
