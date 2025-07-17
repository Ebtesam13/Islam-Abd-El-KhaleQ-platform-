<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categoryNames = ['biology','chemistry','english','mathematics','physics','arabic','geography','history','psychology','philosophy'];
        return [
            'name'=>$categoryNames[array_rand($categoryNames)]
        ];
    }
}
