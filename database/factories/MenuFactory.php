<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categories = [
            'cakes',
            'fish',
            'chicken',
            'pizza',
            'burger',
            'drinks',
            'ice-cream',
            'salads',
            'snacks'
        ];

        $randomCategory = Arr::random($categories);

        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(5),
            'price' => fake()->numberBetween(10, 50),
            'restaurant_id' => Restaurant::factory(),
            'image_url' => $randomCategory . '.jpg'
        ];
    }
}
