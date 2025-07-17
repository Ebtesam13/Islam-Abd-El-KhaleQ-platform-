<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' =>Str::random(6),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'senior_year'=>Carbon::parse(date('Y'))->format('Y'),
            'current_stage'=>array_rand(config('app.current_stage')),
            'area_id'=>$this->faker->numberBetween(1,20),
            'city_id'=>$this->faker->numberBetween(1,20),
            'mobile'=>$this->faker->phoneNumber,
            'mobile_country_code'=>$this->faker->countryCode,
            'whats_app'=>$this->faker->phoneNumber,
            'mom_whats_app'=>$this->faker->phoneNumber,
            'dad_whats_app'=>$this->faker->phoneNumber,
        ];
    }
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
