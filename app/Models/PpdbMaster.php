<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PpdbMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_gelombang','informasi_umum','awal_pendaftaran','akhir_pendaftaran','sekolah_id','is_active'
    ];

    public function ppdb(){
        return $this->hasMany(Ppdb::class,'ppdb_master_id','id');
    }

    public function sekolah(){
        return $this->hasOne(Sekolah::class,'id','sekolah_id');
    }
}
