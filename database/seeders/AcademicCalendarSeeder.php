<?php

namespace Database\Seeders;

use App\Models\AcademicCalendar;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicCalendar::factory()->count(300)->create();
    }
}
