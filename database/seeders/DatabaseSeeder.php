<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Database\Factories\TagFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory(10)->create();
        $categories = Category::factory(10)->create();
        $ingredients = Ingredient::factory(10)->create();

        Meal::factory(20)->create()->each(function($meal) use($tags, $categories, $ingredients) {
            $meal->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            ); 

            $meal->ingredients()->attach(
                $ingredients->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
