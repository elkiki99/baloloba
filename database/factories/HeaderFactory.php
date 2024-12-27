<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Header>
 */
class HeaderFactory extends Factory
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

    public static function defaultHeaders(): array
    {
        return [
            [
                'title' => 'BaloLoba',
                'slug' => 'header-principal',
                'image' => 'components/headers/welcome_header.jpg',
                'sub_title' => 'Fotografía de autor en retratos, moda y eventos',
                'description' => null,
                'button_text' => 'Agendate',
                'button_link' => 'contacto',
            ],
            [
                'title' => 'Portfolio',
                'slug' => 'header-portfolio',
                'image' => 'components/headers/portfolio_header.jpg',
                'sub_title' => 'Explora mi catálogo, conocé mi trabajo',
                'description' => null,
                'button_text' => 'Agendate',
                'button_link' => 'contacto',
            ],
            [
                'title' => 'Sobre mi',
                'slug' => 'header-sobre-mi',
                'image' => 'components/headers/about_header.jpg',
                'sub_title' => 'Tengo más de 4 años de experiencia en fotografía profesional, especializándome en retratos y moda.',
                'description' => 'Capturo momentos únicos con un enfoque creativo y detallado. Tambien realizo coberturas de eventos, transformando momentos importantes en recuerdos inolvidables.',
                'button_text' => null,
                'button_link' => null,
            ],
        ];
    }
}
