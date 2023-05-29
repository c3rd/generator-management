<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generator>
 */
class GeneratorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial' => fake()->numberBetween(10000,99999),
            'brand' => fake()->domainName(),
            'model' => fake()->domainName(),
            'hourmeter' => Str::random(10),
        ];
    }
}
