<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanRpph extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'rpph_id','name','start_time','end_time','langkah'
    ];

    public function rpph(){
        return $this->belongsTo(Rpph::class,'rpph_id','id');
    }
}
