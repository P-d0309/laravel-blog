<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::first()->id,
            'text' => $this->faker->text('25'),
            'description' => $this->faker->text(),
            'seo_description' => $this->faker->text(),
            'likes' => $this->faker->randomNumber(),
            'watch' => $this->faker->randomNumber(),
        ];
    }
}
