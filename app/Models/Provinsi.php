<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'reg_provinces';
    protected $fillable = ['name'];

    public function kota(){
        return $this->hasMany(Kota::class,'province_id','id');
    }
}
