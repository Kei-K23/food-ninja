<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define the categories
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

        // Create categories, restaurants, and menus
        foreach ($categories as $categoryName) {
            $category = Category::create([
                'name' => $categoryName,
                'image_url' => "$categoryName.jpg" // Assuming images are named as per category names
            ]);

            $this->createRestaurantsAndMenus($category);
        }
    }

    // Helper function to create restaurants and menus for a given category
    private function createRestaurantsAndMenus(Category $category): void
    {
        $category->restaurants()->createMany(
            Restaurant::factory()
                ->count(random_int(1, 2)) // Random number of restaurants per category
                ->raw(['category_id' => $category->id]) // Set category_id
        )->each(function ($restaurant) {
            $restaurant->menus()->createMany(
                Menu::factory()->count(10)->raw(['restaurant_id' => $restaurant->id]) // Create 10 menus per restaurant
            );
        });
    }
}
