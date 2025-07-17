<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Course;
use App\Models\CourseRate;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $userIds = $users->pluck('id')->toArray();
        $categories = Category::factory(10)->create();
        $categoryIds = $categories->pluck('id')->toArray();
        Course::truncate();
        $courses[] = Course::factory()->create([
            'name' => 'Third secondary',
            'description' => 'Chemistry 3rd sec.',
            'category_id' => array_rand($categoryIds),
            'author_id' => array_rand($userIds),
            'image_path' => "img/stage3.jpeg",
        ]);
        $courses[] = Course::factory()->create([
            'name' => 'Second secondary',
            'description' => 'Chemistry  2nd sec.',
            'category_id' => array_rand($categoryIds),
            'author_id' => array_rand($userIds),
            'image_path' =>"img/stage2.jpeg",
        ]);
        $courses[] = Course::factory()->create([
            'name' => 'First secondary',
            'description' => 'Integrated Science',
            'category_id' => array_rand($categoryIds),
            'author_id' => array_rand($userIds),
            'image_path' => "img/stage1.jpeg",
        ]);
        $courses[] = Course::factory()->create([
            'name' => 'Science 3 prep',
            'description' => 'Science 3 prep.',
            'category_id' => array_rand($categoryIds),
            'author_id' => array_rand($userIds),
            'image_path' => "img/stage4.jpeg",
        ]);
        foreach ($courses as $index=>$course) {
            CourseRate::factory(8)->create([
                'course_id' => $course->id,
            ]);
            CourseUser::factory($index +5)->create([
                'course_id' => $course->id,
                'user_id' => array_rand($userIds),
            ]);
//            Lesson::factory(6)->create([
//                'unit_id' => $course->id,
//            ]);
        }
        City::truncate();
        Area::truncate();
        foreach (config('cities') as $cityArray) {
            City::factory()->create([
                'id' => $cityArray['id'],
                'city_name_ar' => $cityArray['city_name_ar'],
                'city_name_en' => $cityArray['city_name_en'],
            ]);
            foreach (config('areas') as $areaArray) {
                if($areaArray['city_id'] == $cityArray['id'])
                Area::factory()->create([
                    'id' => (integer)$areaArray['id'],
                    'city_id' => (integer)$areaArray['city_id'],
                    'area_name_ar' => $areaArray['area_name_ar'],
                    'area_name_en' => $areaArray['area_name_en'],
                ]);
            }
        }
        $this->call(RoleSeeder::class);
    }
}
