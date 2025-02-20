<?php

namespace Database\Factories;

use App\Enums\CadreLevel;
use App\Enums\Gender;
use App\Models\Cadre;
use App\Models\PAC;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cadre>
 */
class CadreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cadreLevel = $this->faker->randomElement(CadreLevel::getAll());

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'nim' => $this->faker->optional()->numerify('########'),
            'gender' => $this->faker->randomElement(Gender::getAll()),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->numerify('08###########'),
            'highschool' => $this->faker->company(),
            'grad_year' => $this->faker->year(),
            'boarding_school' => $this->faker->company(),
            'college_year' => $this->faker->year(),
            'organizer_makesta' => PAC::all()->random()->pac_name,
            'cadre_level' => $cadreLevel,
            'makesta_year' =>
                $cadreLevel == CadreLevel::MAKESTA->value ? $this->faker->numberBetween(2016, 2025) : null,
            'lakmud_year' => $cadreLevel == CadreLevel::LAKMUD->value ? $this->faker->numberBetween(2016, 2025) : null,
            'lakut_year' => $cadreLevel == CadreLevel::LAKUT->value ? $this->faker->numberBetween(2016, 2025) : null,
            'latinpel_year' =>
                $cadreLevel == CadreLevel::LATINPEL->value ? $this->faker->numberBetween(2016, 2025) : null,
            'informal' => strval(rand(1, 9)),
            'nonformal' => strval(rand(1, 9)),
            'organizer_informal' => $this->faker->optional()->company(),
            'organizer_nonformal' => $this->faker->optional()->company(),
            'img' => 'default.png',
            'pac_id' => $this->faker->numberBetween(1, 29),
        ];
    }
}
