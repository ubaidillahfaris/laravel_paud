<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Siswa extends Model
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
        'alamat',
        'ortu_user_id'
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

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }

    public function kota_lahir(){
        return $this->hasOne(Kota::class,'id','kota_lahir');
    }

    public function tagihan(){
        return $this->hasMany(Tagihan::class,'siswa_id','id')
        ->where('status','send');
    }

    public function tabungan(){
        return $this->hasOne(Tabungan::class,'siswa_id','id');
    }

    public function rpph(){
        return $this->hasOneThrough(Rpph::class,Kelas::class,'id','kelas_id','kelas_id','id');
    }

    public function asesmen_ceklis(){
        return $this->hasMany(AsesmenCeklis::class,'siswa_id','id');
    }

    public function asesmen_dokumen_karya(){
        return $this->hasMany(AsesmenDokumenKarya::class,'siswa_id','id');
    }

    public function asesmen_catatan_anekdot(){
        return $this->hasMany(AsesmenCatatanAnekdot::class,'siswa_id','id');
    }

    public function asesmen_foto_berseri(){
        return $this->hasMany(AsesmenFotoBerseri::class,'siswa_id','id');
    }

    public function portofolio_siswa(){
        return $this->hasMany(PortofolioSiswa::class,'siswa_id','id');
    }

    public function presensi(){
        return $this->hasMany(Presensi::class,'siswa_id','id');
    }
}
