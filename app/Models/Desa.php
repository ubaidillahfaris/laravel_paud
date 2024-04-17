<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $table = 'reg_villages';
    protected $fillable = [
        'district_id',
        'name',
    ];

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class,'id','district_id');
    }
}
