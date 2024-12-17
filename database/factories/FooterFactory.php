<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Footer>
 */
class FooterFactory extends Factory
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

    public function defaultFooter()
    {
        return [
            'title' => 'Sobre mi',
            'description' => 'Soy fotógrafa y me encanta transformar momentos especiales en imágenes que no solo se quedan en el recuerdo, sino que también conectan de verdad con cada persona, contando historias únicas en cada foto.',
        ];
    }
}
