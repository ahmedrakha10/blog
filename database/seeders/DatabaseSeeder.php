<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Category::truncate();
        Article::truncate();
        User::create([
                         'name'     => 'Admin',
                         'email'    => 'admin@admin.com',
                         'password' => bcrypt(123)
                     ]);
        User::factory(10)->create();
        Category::factory(10)->create();
        Article::factory(10)->create();
    }
}
