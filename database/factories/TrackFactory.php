<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TrackFactory extends Factory
{
    public function definition()
    {
        $endOfThisMonth = now()->endOfMonth();
        $startOfLastMonth = now()->subMonth()->startOfMonth();

        $randomDate = fake()->dateTimeBetween($startOfLastMonth, $endOfThisMonth);

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'genre' => $this->faker->word,
            'music_file' => $this->faker->word . '.mp3',
            'cover_file' => $this->faker->word . '.jpg',
            'created_at' => $randomDate,
        ];
    }
}
