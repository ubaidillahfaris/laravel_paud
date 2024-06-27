<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Ppdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ppdb_master_id',
        'kelas_id',
        'nama_lengkap',
        'nama_panggilan',
        'nik',
        'anak_ke',
        'jenis_kelamin',
        'kota_lahir',
        'tanggal_lahir',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_hp_ibu',
        'foto',
        'provinsi',
        'kota_kab',
        'kecamatan',
        'kelurahan',
        'alamat',
        'ortu_user_id',
        'status'
    ];

    protected $appends = ['foto_url'];

    public function getFotoUrlAttribute()
    {
        return url(
            Storage::url($this->attributes['foto'])
        );
    }

    public function sekolah(){
        return $this->hasOneThrough(Sekolah::class,PpdbMaster::class, 'id','id','ppdb_master_id','sekolah_id');
    }

    public function ppdbMaster(){
        return $this->belongsTo(PpdbMaster::class,'ppdb_master_id','id');
    }

    protected $casts = [
        'kota_lahir' => 'string', 
        'provinsi' => 'string', 
        'kota_kab' => 'string', 
        'kecamatan' => 'string', 
        'kelurahan' => 'string', 
    ];

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }

    public function kota_lahir(){
        return $this->hasOne(Kota::class,'id','kota_lahir');
    }

    public function provinsi(){
        return $this->hasOne(Provinsi::class,'id','provinsi');
    }

    public function kota_kab(){
        return $this->hasOne(Kota::class,'id','kota_kab');
    }

    public function kecamatan(){
        return $this->hasOne(Kecamatan::class,'id','kecamatan');
    }

    public function kelurahan(){
        return $this->hasOne(Desa::class,'id','kelurahan');
    }
}
