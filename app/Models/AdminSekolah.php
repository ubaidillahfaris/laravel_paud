<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminSekolah extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id','sekolah_id'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function sekolah(){
        return $this->hasOne(Sekolah::class,'id','sekolah_id');
    }
}
