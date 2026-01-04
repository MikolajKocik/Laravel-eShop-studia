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
        $electronic = Category::create(['name' => 'Elektronika']);
        $clouthes = Category::create(['name' => 'Odzież']);
        $books = Category::create(['name' => 'Książki']);

        // Create Products
        Product::factory(20)->create(['category_id' => $electronic->id]);
        Product::factory(20)->create(['category_id' => $clouthes->id]);
        Product::factory(20)->create(['category_id' => $books->id]);

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
