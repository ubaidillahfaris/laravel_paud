<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenCeklis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'siswa_id','rpph_id','tahun_ajaran_id',
        'konteks','penilaian','kejadian_teramati'
    ];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'siswa_id','id');
    }

    public function rpph(){
        return $this->belongsTo(Rpph::class,'rpph_id','id');
    }

    public function tahun_ajaran(){
        return $this->belongsTo(TahunPelajaran::class,'tahun_ajaran_id','id');
    }
}
