<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $tags = Tag::all();

        // Get or create sellers/creators (Admin or Editor)
        $creatorUsers = User::whereIn('role', [UserRole::Admin, UserRole::Editor])->get();

        if ($creatorUsers->isEmpty()) {
            $creatorUsers = User::factory(2)->admin()->create();
        }

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        if ($tags->isEmpty()) {
            $this->call(TagSeeder::class);
            $tags = Tag::all();
        }

        // Generate at least 50 products using only seeded categories
        for ($i = 0; $i < 50; $i++) {
            $product = Product::factory()->create([
                'category_id' => $categories->random()->id,
                'user_id' => $creatorUsers->random()->id,
            ]);

            // Attach 1 to 3 random tags for each product
            $randomTags = $tags->random(fake()->numberBetween(1, min(3, $tags->count())));
            $product->tags()->attach($randomTags);
        }
    }
}
