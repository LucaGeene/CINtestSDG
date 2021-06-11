<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'verified' => $this->faker->numberBetween(0,1),
            'goalId' => $this->faker->numberBetween(1,17),
            'activity_type' => $this->faker->word(),
            'education_id' => $this->faker->numberBetween(1, 23),
            'title' => $this->faker->name(),
            'excerpt' => $this->faker->text(100),
            'category' => $this->faker->text(30),
            'education' => $this->faker->text(20),
            'body' => $this->faker->text(1000)
        ];
    }
}
