<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
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
    
    public static function defaultSections(): array
    {
        return [
            [
                'title' => 'Camila Fernández',
                'slug' => 'camila-fernandez',
                'image' => 'components/sections/camila_fernandez.jpg',
                'sub_title' => 'Especializada en retratos, moda y eventos con un enfoque artístico único.',
                'description' => '- Fundadora y alma creativa detrás de Balo Loba.',
                'button_text' => 'Sobre mi',
                'button_link' => 'about',
            ],
            [
                'title' => 'Situado en el corazón de Palermo',
                'slug' => 'mi-estudio',
                'image' => 'components/sections/mi_estudio.jpg',
                'sub_title' => null,
                'description' => null,
                'button_text' => 'Agendate',
                'button_link' => 'contact',
            ],
        ];
    }
}
