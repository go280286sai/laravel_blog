<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->slug(),
            'content' => fake()->text(),
            'description' => fake()->text(),
            'image' => 'B4n4Aj3NHM.png',
            'category_id' => random_int(1, 5),
            'user_id' => 1,
            'status' => 1,
            'views' => random_int(0, 5000),
            'is_featured' => 0,
            's_date' => '2020-02-28',
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
