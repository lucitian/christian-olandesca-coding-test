<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name, '-');

        return [
            //
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(2),
            'price' => $this->faker->numberBetween(999, 19999)
        ];
    }
}
