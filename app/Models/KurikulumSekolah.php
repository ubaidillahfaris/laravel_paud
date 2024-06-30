<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KurikulumSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['kurikulum_id','sekolah_id'];

    public function kurikulum(){
        return $this->hasOne(Kurikulum::class,'id','kurikulum_id');
    }

    public function sekolah(){
        return $this->hasOne(Sekolah::class,'id','sekolah_id');
    }
}
