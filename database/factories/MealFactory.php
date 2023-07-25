<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MealFactory extends Factory
{
    public function definition(): array
    {
        $faker = Faker::create();
        $rand = rand(100,999);
        return [
            'en' => ['title' => 'Meal' . $rand . ' in English', 'description' => 'Description' . $rand . ' in English'],
            'fr' => ['title' => 'Meal' . $rand . ' in French', 'description' => 'Description' . $rand . ' in French'],
            'category_id' => rand(1,8)
        ];
    }
}
