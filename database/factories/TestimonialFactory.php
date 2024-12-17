<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }

    public function defaultTestimonials()
    {
        return [
            [
                'name' => 'Valentina Camejo',
                'slug' => 'valentina-camejo',
                'profile_image' => 'components/testimonials/valentina_camejo.jpg',
                'headline' => 'Miss Mundo Uruguay 2020',
                'quote' => 'Camila es una artista en todo el sentido de la palabra. Ha trabajado con nuestras modelos en producciones increíbles, capturando su esencia con una visión única. Cada sesión con ella es mágica.',
                'username' => '@valentinacamejo16',
                'bio' => 'Valentina Camejo, Miss Mundo Uruguay 2020 y directora de Miss Océano y Turismo. Lidera con excelencia uno de los certámenes internacionales de belleza más destacados de Uruguay.',
            ],
            [
                'name' => 'Victoria Otero',
                'slug' => 'victoria-otero',
                'profile_image' => 'components/testimonials/victoria_otero.jpg',
                'headline' => 'Actriz',
                'quote' => 'Fue un placer trabajar con Camila, entendió perfecto lo que quería en mis fotos, sin dudas volvería a elegir este servicio!',
                'username' => '@vicootero',
                'bio' => 'Victoria Otero es una actriz uruguaya profesional, se destaca en teatro independiente.',
            ],
            [
                'name' => 'Pia Mallarini',
                'slug' => 'pia-mallarini',
                'profile_image' => 'components/testimonials/pia_mallarini.jpg',
                'headline' => 'Actriz',
                'quote' => 'Camila tiene un don para hacer que te sientas cómodo frente a la cámara. Su energía y profesionalismo son incomparables, y el resultado final es siempre sorprendente. ¡Es una genia!',
                'username' => '@piamallarini_',
                'bio' => 'Pia Mallarini, actriz uruguaya profesional que se destaca principalmente en teatro nacional.',
            ],
            [
                'name' => 'Diana Morgades',
                'slug' => 'diana-morgades',
                'profile_image' => 'components/testimonials/diana_morgades.jpg',
                'headline' => 'Directora Nacional',
                'quote' => 'Trabajar con Camila es una experiencia increíble. Su creatividad y atención a los detalles hacen que cada sesión sea única, y el resultado final siempre supera cualquier expectativa. ¡100% recomendada!',
                'username' => '@morgades_diana',
                'bio' => 'Diana Morgades, directora nacional de Miss Teen Universal Uruguay y Miss Supranational.',
            ],
        ];
    }
}
