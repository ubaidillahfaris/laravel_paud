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
}
