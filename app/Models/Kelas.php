<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nama','tahun_pelajaran_id','sekolah_id'];

    public function tahun_ajaran(){
        return $this->hasOne(TahunPelajaran::class,'id','tahun_pelajaran_id');
    }
}
