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
        $categories = json_decode(file_get_contents(database_path('data/categories.json')), true);
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }

        $products = json_decode(file_get_contents(database_path('data/productsToSeed.json')), true);
        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        $users = json_decode(file_get_contents(database_path('data/users.json')), true);
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'role' => $user['role'],
            ]);
        }
    }
}
