<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Member;
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
        $isMakesta = $this->faker->boolean();
        $isLakmud = $this->faker->boolean();
        $isLakut = $this->faker->boolean();
        $isDiklatama = $this->faker->boolean();
        $isDiklatnas = $this->faker->boolean();
        $isDiklatmad = $this->faker->boolean();
        $isLatinpel = $this->faker->boolean();

        if ($isLakmud) {
            $isMakesta = true;
        }

        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(Gender::getAll()),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->date(),
            'is_makesta' => $isMakesta,
            'is_lakmud' => $isDiklatnas,
            'is_lakut' => $isLakut,
            'makesta_year' => $isMakesta ? $this->faker->numberBetween(2016, 2025) : null,
            'lakmud_year' => $isLakmud ? $this->faker->numberBetween(2016, 2025) : null,
            'lakut_year' => $isLakut ? $this->faker->numberBetween(2016, 2025) : null,
            'is_diklatama' => $isDiklatama,
            'is_diklatnas' => $isDiklatnas,
            'is_diklatmad' => $isDiklatmad,
            'is_latinpel' => $isLatinpel,
            'phone' => $this->faker->numerify('08###########'),
            'photo' => 'default.png',
            'pac_id' => $this->faker->numberBetween(1, 29),
        ];
    }
}
