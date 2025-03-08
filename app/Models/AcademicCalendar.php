<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'event_date',
        'description',
        'tahun_pelajaran_id', // Foreign key to TahunPelajaran
    ];

    protected $appends = ['semester'];

    /**
     * Relasi ke model TahunPelajaran.
     */
    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaran::class, 'tahun_pelajaran_id');
    }

    /**
     * Mendapatkan semester melalui relasi ke TahunPelajaran.
     */
    public function getSemesterAttribute()
    {
        return $this->tahunPelajaran ? $this->tahunPelajaran->semester : null;
    }
}
