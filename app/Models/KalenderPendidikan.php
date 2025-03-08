<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KalenderPendidikan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sekolah_id','tahun_ajaran_id','nama','deskripsi','start_date','end_date'
    ];

    public function sekolah(){
        return $this->belongsTo(Sekolah::class,'sekolah_id','id');
    }
}
