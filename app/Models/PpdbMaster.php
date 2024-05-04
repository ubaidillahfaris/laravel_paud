<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_gelombang','informasi_umum','awal_pendaftaran','akhir_pendaftaran'
    ];
}
