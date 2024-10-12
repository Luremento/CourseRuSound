<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TrackFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'genre' => $this->faker->word,
            'music_file' => $this->faker->word . '.mp3',
            'cover_file' => $this->faker->word . '.jpg',
        ];
    }
}
