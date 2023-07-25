<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class IngredientFactory extends Factory
{
    public function definition(): array
    {
        $faker = Faker::create();
        $rand = rand(100,999);
        return [
            'en' => ['title' => 'Ingredient' . $rand . ' in English'],
            'fr' => ['title' => 'Ingredient' . $rand . ' in French'],
            'slug'=>$faker->slug(),
        ];
    }
}
