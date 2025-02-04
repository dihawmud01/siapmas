<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(15),
            'username' => fake()
                ->unique()
                ->name(13),
            'role_id' => Arr::random(['1', '2', '3', '4', '5']),
            'makesta_year' => Arr::random(['2018', '2019', '2020', '2021', '2022', '2023', '2024']),
            'gender' => Arr::random(['L', 'P']),
            'email' => fake()->email(),
            'pac_id' => Arr::random(['1', '2', '3', '4', '5', '6']),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'cadre_level' => Arr::random(['Belum Makesta', 'Makesta', 'Lakmud', 'Lakut', 'Latinpel']),
            'nim' => fake()->numberBetween(5, 9999),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(
            fn (array $attributes) => [
                'email_verified_at' => null,
            ],
        );
    }
}
