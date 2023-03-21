<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'start' => $this->faker->dateTime(),
            'end' => $this->faker->dateTime(),
            'sponsor' => $this->faker->text(8),
            'value' => $this->faker->text(10),
            'description' => $this->faker->text(20),
            'status' => $this->faker->text(5),
            'user_id' => 1,
            'progress' => $this->faker->randomDigit() . "%",
        ];
    }
}