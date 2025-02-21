<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'image_url' => $this->faker->imageUrl(),
            'genre_id' => $this->faker->numberBetween(1, 10),
            'published_year' => $this->faker->year,
            'description' => $this->faker->realText(20),
            'is_showing' => $this->faker->boolean,

            // 'published_year' => $this->faker->year,
            // 'description' => $this->faker->realText(20),
            // 'is_showing' => $this->faker->boolean,
        ];
    }
}
