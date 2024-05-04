<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyAsesmen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ppdb_master','data'];

    protected $casts = [
        'data' => 'array'
    ];
}
