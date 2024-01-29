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
            Category::create([
                'name' => $categoryName,
                'image_url' => "$categoryName.jpg"
            ]);
        }

        $dataCategories = Category::all();

        foreach ($dataCategories as $dataC) {
            $this->createRestaurantsAndMenus($dataC);
        }
    }

    private function createRestaurantsAndMenus(Category $category): void
    {
        $categories = Category::all();

        Restaurant::factory()
            ->count(random_int(1, 3))
            ->create([
                'image_url' => $category->image_url
            ])->each(function ($restaurant) use ($categories) {
                $categories->shuffle();

                $categories->each(function ($cat) use ($restaurant) {
                    $restaurant->menus()->createMany(
                        Menu::factory()
                            ->count(10)
                            ->make([
                                'category_id' => $cat->id,
                                'restaurant_id' => $restaurant->id,
                                'image_url' => $cat->image_url
                            ])
                            ->toArray()
                    );
                });
            });
    }
}
