<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id','sekolah_id','kelas_id'
    ];

    public function akun(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function sekolah(){
        return $this->hasOne(Sekolah::class,'id','sekolah_id');
    }

    public function kelas(){
        return $this->hasOne(Kelas::class,'id','kelas_id');
    }
}
