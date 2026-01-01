<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Categories
        $elektronika = Category::create(['name' => 'Elektronika']);
        $odziez = Category::create(['name' => 'Odzież']);
        $ksiazki = Category::create(['name' => 'Książki']);

        // Create Products
        Product::factory(5)->create(['category_id' => $elektronika->id]);
        Product::factory(5)->create(['category_id' => $odziez->id]);
        Product::factory(5)->create(['category_id' => $ksiazki->id]);

        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Create Regular User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
