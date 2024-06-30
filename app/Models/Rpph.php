<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rpph extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'kelas_id',
        'semester_id',
        'kurikulum_id',
        'tema','sub_tema','start_date','end_date',
        'guru_id','capaian_pembelajaran','tujuan_pembelajaran','metode',
        'sumber_belajar','alat_bahan',
    ];


    public function guru(){
        return $this->hasOne(User::class,'id','guru_id');
    }

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }

    public function semester(){
        return $this->hasOne(TahunPelajaran::class,'id','semester_id');
    }

    public function kurikulum(){
        return $this->hasOne(Kurikulum::class,'id','kurikulum_id');
    }

    public function kegiatan(){
        return $this->hasMany(KegiatanRpph::class,'rpph_id','id');
    }
}
