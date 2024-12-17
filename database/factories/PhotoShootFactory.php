<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoShoot>
 */
class PhotoShootFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'cover_photo' => $this->faker->imageUrl(),
            'header_photo' => $this->faker->imageUrl(),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['published', 'draft', 'client_preview']),
            'category_id' => $this->faker->randomElement([1, 2, 3]),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'location' => $this->faker->city(),
            'duration' => $this->faker->randomFloat(2, 0, 1000),
            'slug' => Str::slug($this->faker->name()),
        ];
    }
}
