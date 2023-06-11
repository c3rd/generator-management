<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'hourmeter' => fake()->numberBetween(1, 1000),
            'service_date' => fake()->date(),
            'employee_id' => fake()->numberBetween(1,10),
            'generator_id' => fake()->numberBetween(1,10),
        ];
    }
}
