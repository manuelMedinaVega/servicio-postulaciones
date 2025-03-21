<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'slug' => $this->faker->unique()->slug,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->city,
            'opened_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
