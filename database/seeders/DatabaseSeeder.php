<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Package;
use App\Models\Category;
use App\Models\PhotoShoot;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Factories\PackageFactory;
use Database\Factories\CategoryFactory;

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

        foreach ($categories as $category) {
            Category::create($category);
        }
        
        $packages = PackageFactory::new()->defaultPackages();

        foreach($packages as $package) {
            Package::create($package);
        }

        PhotoShoot::factory(30)->create();
    }
}
