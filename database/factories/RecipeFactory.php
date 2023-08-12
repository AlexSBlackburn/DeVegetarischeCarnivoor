<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'user_id' => 1,
            'slug' => $this->faker->slug,
            'intro' => $this->faker->paragraph,
            'cook_time' => $this->faker->numberBetween(5, 60),
            'servings' => $this->faker->numberBetween(1, 10),
            'ingredients' => [
                [
                    'amount' => $this->faker->numberBetween(1, 10),
                    'unit' => $this->faker->randomElement(['cup', 'tsp', 'tbsp', 'grams', 'ml']),
                    'name' => $this->faker->word,
                ]
            ],
//            'steps' => [$this->faker->sentence],
//            'notes' => [$this->faker->sentence],
            'body' => $this->faker->paragraphs(3, true),
        ];
    }
}
