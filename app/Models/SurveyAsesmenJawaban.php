<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyAsesmenJawaban extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ppdb_master_id','ortu_id','anak_id','data'];
}
