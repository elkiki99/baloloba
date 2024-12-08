<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
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

    public function defaultPackages()
    {
        return [
            [
                'name' => 'Polaroids',
                'basic_price' => '2499',
                'extended_price' => '3199',
                'before_basic_price' => round(2499 / 0.85, 2),
                'before_extended_price' => round(3199 / 0.85, 2),
                'description' => 'Fotografías instantáneas clásicas',
                'basic_features' => json_encode([
                    '10 fotografías instantáneas impresas',
                    'Selección de fondo o marco prediseñado',
                    'Sesión de 30 minutos',
                    'Entrega en el momento',
                    'Opciones de retoque básico'
                ]),
                'extended_features' => json_encode([
                    '20 fotografías instantáneas impresas',
                    'Personalización de marcos con diseños únicos',
                    'Sesión de 1 hora',
                    'Álbum compacto de recuerdos',
                    'Retoques avanzados en fotografías seleccionadas'
                ])
            ],
            [
                'name' => 'Moda',
                'basic_price' => '3199',
                'extended_price' => '4499',
                'before_basic_price' => round(3199 / 0.85, 2),
                'before_extended_price' => round(4499 / 0.85, 2),
                'description' => 'Fotografía de estilo y moda',
                'basic_features' => json_encode([
                    '5 looks o cambios de vestuario',
                    'Dirección de poses básica',
                    'Sesión de 1 hora',
                    'Entrega de 15 fotografías digitales',
                    'Opciones de retoque básico'
                ]),
                'extended_features' => json_encode([
                    '10 looks o cambios de vestuario',
                    'Dirección profesional de poses',
                    'Sesión de 2 horas',
                    'Entrega de 30 fotografías digitales',
                    'Edición avanzada con retoque de alta moda'
                ])
            ],
            [
                'name' => 'Eventos',
                'basic_price' => '4499',
                'extended_price' => '5799',
                'before_basic_price' => round(4499 / 0.85, 2),
                'before_extended_price' => round(5799 / 0.85, 2),
                'description' => 'Cobertura de eventos sociales',
                'basic_features' => json_encode([
                    'Cobertura de 2 horas',
                    'Entrega de 50 fotografías digitales',
                    'Edición básica en todas las imágenes',
                    'Galería privada para descargar las fotos',
                    'Fotografías grupales y espontáneas'
                ]),
                'extended_features' => json_encode([
                    'Cobertura de 5 horas',
                    'Entrega de 150 fotografías digitales',
                    'Edición avanzada en todas las imágenes',
                    'Álbum digital personalizado',
                    'Fotografía adicional con dron (si aplica)'
                ])
            ]
        ];
    }
}
