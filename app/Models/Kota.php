<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'reg_regencies';
    protected $fillable = ['province_id','name'];

    protected $cast = [
        'id' => 'bigInt'
    ];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'id','province_id');
    }

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class,'regency_id','id');
    }
}
