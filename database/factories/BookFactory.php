<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->words(rand(1,5), true)),
            'author' => fake()->name(),
            'language' => fake()->randomElement(\App\Models\Book::$languages),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2,50,1500),
            'category' => fake()->randomElement(\App\Models\Book::$categories),
            'stock' => fake()->numberBetween(5,100)
        ];
    }
}
