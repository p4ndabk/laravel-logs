<?php

namespace Database\Factories;
 
use Illuminate\Database\Eloquent\Factories\Factory;
 
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'price' => fake()->randomFloat(2, 10, 100),
        ];
    
    }
}
