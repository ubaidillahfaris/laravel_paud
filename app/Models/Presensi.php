<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presensi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'tahun_ajaran_id',
        'tanggal',
        'status',
        'created_by',
    ];

    public function siswa(){
        return $this->hasOne(Siswa::class,'id','siswa_id');
    }

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }

    public function tahun_ajaran(){
        return $this->hasOne(TahunPelajaran::class,'id','tahun_ajaran_id');
    }

    public function created_by(){
        return $this->hasOne(User::class,'id','created_by');
    }
}
