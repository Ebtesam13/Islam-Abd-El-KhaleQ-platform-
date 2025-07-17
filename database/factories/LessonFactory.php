<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;

class LessonFactory extends Factory
{
    public function definition(): array
    {
        // Generate a fake image file
//        $fakeFile = $this->faker->image();

        // Store the file in the public storage (or any other location)
//        $filePath = Storage::putFile('public/videos', new File($fakeFile));
        return [
            'name'=>'lesson '.$this->faker->numberBetween(1,15),
            'description'=>$this->faker->text,
            'duration'=>$this->faker->numberBetween(1,2.5),
            'unit_id'=>$this->faker->numberBetween(1,8),
            'price'=>$this->faker->numberBetween(1,8),
            'expiry_days'=>10,
            'number_of_codes'=>$this->faker->numberBetween(1,20),
            'video'=>'test',
        ];
    }
}
