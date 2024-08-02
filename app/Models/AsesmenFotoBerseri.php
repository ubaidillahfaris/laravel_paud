<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenFotoBerseri extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'siswa_id',
        'rpph_id',
        'tahun_ajaran_id',
        'nilai_agama_budi_pekerti',
        'jati_diri',
        'literasi_steam',
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

    public function foto(){
        return $this->hasMany(AsesmenFotoBerseriFile::class,'asesmen_foto_id','id');
    }
}
