<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => $this->faker->numberBetween(1, 10),
            'category_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->title(),
            'description' => $this->faker->sentence(5),
            'status' => $this->faker->randomElement(['pending', 'working', 'done']),
            'due_date' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
