<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $courseNames = ['physical chemistry','biology','organic chemistry','english','algebra','calculus','analytical chemistry','geometry','physics',
            'arabic','geography','history','psychology','philosophy'];
        return [
            'name'=>$courseNames[array_rand($courseNames)],
            'description'=>$this->faker->text,
            'price'=>$this->faker->randomNumber(3),
            'hours'=>$this->faker->randomNumber(2),
            'category_id'=>1,
            'author_id'=>1
        ];
    }
}
