<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseRateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => $this->faker->numberBetween(0, 5),
            'user_id' => $this->faker->numberBetween(0, 5),
            'rate' => $this->faker->numberBetween(0, 5)
        ];
    }
}
