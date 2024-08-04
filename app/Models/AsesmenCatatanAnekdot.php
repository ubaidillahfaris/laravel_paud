<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenCatatanAnekdot extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'siswa_id',
        'rpph_id',
        'tahun_ajaran_id',
        'jam',
        'tempat_kejadian',
        'deskripsi_peristiwa',
        'nilai_agama_budi_pekerti',
        'jati_diri',
        'literasi_steam',
        'umpan_balik'
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
