<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function defaultCategories()
    {
        return [
            ['name' => 'Polaroids', 'slug' => 'polaroids', 'description' => 'Fotografías instantáneas clásicas.'],
            ['name' => 'Moda', 'slug' => 'moda', 'description' => 'Fotografía de estilo y moda.'],
            ['name' => 'Eventos', 'slug' => 'eventos', 'description' => 'Cobertura de eventos sociales.'],
        ];
    }
}
