<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunPelajaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start_tahun','end_tahun','semester','id_kota_pembagian_raport','tanggal_pembangian_raport','status'
    ];
}
