<?php

namespace Database\Factories;

use App\Models\TahunPelajaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicCalendar>
 */
class AcademicCalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'event_date' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'description' => $this->faker->sentence(6),
            'tahun_pelajaran_id' => TahunPelajaran::inRandomOrder()->first()->id, // Assumes you have TahunPelajaran data
        ];
    }
}
