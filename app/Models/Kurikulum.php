<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kurikulum extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','is_active','curriculum_start_date','curriculum_end_date','sekolah_id'];

    public function sekolah(){
        return $this->hasManyThrough(Sekolah::class,KurikulumSekolah::class,'kurikulum_id','id','id','sekolah_id');
    }
}
