<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'category_id' => $this->faker->unique()->numberBetween(1, Category::count()),
            'image'       => 'https://source.unsplash.com/random'
        ];
    }
}
