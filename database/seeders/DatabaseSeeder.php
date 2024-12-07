<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Package;
use App\Models\Category;
use App\Models\PhotoShoot;
use Illuminate\Database\Seeder;
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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
