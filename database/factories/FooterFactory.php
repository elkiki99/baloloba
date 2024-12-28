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
            'address' => 'https://www.google.com/maps/place/Balo+Loba+Fotograf%C3%ADa/@-34.9108155,-56.1835782,17z/data=!3m1!4b1!4m6!3m5!1s0x959f81b09abd9171:0xcc8f13d506d17e44!8m2!3d-34.9108199!4d-56.1810033!16s%2Fg%2F11tn84rl3g?entry=ttu&g_ep=EgoyMDI0MTExOS4yIKXMDSoASAFQAw%3D%3D',
            'phone' => '(+598) 92 299 682',
            'email' => 'baloloba.uy@gmail.com',
            'linkedin' => 'https://www.linkedin.com/in/camila-fernandez16/',
            'instagram' => 'https://www.instagram.com/balo_loba',
        ];
    }
}
