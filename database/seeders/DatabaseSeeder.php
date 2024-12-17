<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Package;
use App\Models\Section;
use App\Models\Category;
use App\Models\PhotoShoot;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Factories\FooterFactory;
use Database\Factories\HeaderFactory;
use Database\Factories\PackageFactory;
use Database\Factories\SectionFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\TestimonialFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Camila',
            'email' => 'baloloba.uy@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Neron101'),
            'isAdmin' => true,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $categories = CategoryFactory::new()->defaultCategories();
        $packages = PackageFactory::new()->defaultPackages();
        $headers = HeaderFactory::new()->defaultHeaders();
        $sections = SectionFactory::new()->defaultSections();
        $testimonials = TestimonialFactory::new()->defaultTestimonials();
        $footer = FooterFactory::new()->defaultFooter();

        Footer::create($footer);

        foreach ($categories as $category) {
            Category::create($category);
        }

        foreach ($packages as $package) {
            Package::create($package);
        }

        foreach ($headers as $header) {
            Header::create($header);
        }

        foreach ($sections as $section) {
            Section::create($section);
        }
        
        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }

        PhotoShoot::factory(30)->create();
    }
}
