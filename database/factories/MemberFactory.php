<?php

namespace Database\Factories;

use App\Enums\CadreLevel;
use App\Enums\Gender;
use App\Models\Member;
use App\Models\PAC;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cadreLevels = $this->faker->randomElements(array_filter(CadreLevel::getAll()), rand(1, 4));

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(Gender::getAll()),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->numerify('08###########'),
            'cadre_levels' => json_encode($cadreLevels),
            'makesta_year' => in_array(CadreLevel::MAKESTA->value, $cadreLevels)
                ? $this->faker->numberBetween(2016, 2025)
                : null,
            'lakmud_year' => in_array(CadreLevel::LAKMUD->value, $cadreLevels)
                ? $this->faker->numberBetween(2016, 2025)
                : null,
            'lakut_year' => in_array(CadreLevel::LAKUT->value, $cadreLevels)
                ? $this->faker->numberBetween(2016, 2025)
                : null,
            'latinpel_year' => in_array(CadreLevel::LATINPEL->value, $cadreLevels)
                ? $this->faker->numberBetween(2016, 2025)
                : null,
            'nonformal' => strval(rand(1, 9)),
            'organizer_informal' => $this->faker->optional()->company(),
            'organizer_nonformal' => $this->faker->optional()->company(),
            'img' => 'default.png',
            'pac_id' => $this->faker->numberBetween(1, 29),
        ];
    }
}
