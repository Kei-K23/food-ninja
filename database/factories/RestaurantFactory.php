<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RestaurantFactory extends Factory
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
            'name' => fake()->company(),
            'category_id' => Category::factory(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'image_url' => $randomCategory . '.jpg'
        ];
    }
}
