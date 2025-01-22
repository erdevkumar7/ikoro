<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EquipmentPriceFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'equipment_id' => fake()->numberBetween(30, 240),
            'equipment_name' => fake()->word(),
            'price' => fake()->randomFloat(2, 50, 1000),
            'minutes' => fake()->numberBetween(30, 240),
        ];
    }
}
