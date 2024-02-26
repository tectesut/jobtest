<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

class ItemFactory extends Factory
{
    public function definition(): array
    {
        $imagePath = 'item_images/' . $this->faker->image(public_path('storage/item_images'), 400, 300, null, false);
    
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word,
            'image_path' => $imagePath,
            'type' => $this->faker->word,
            'detail' => $this->faker->sentence,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}