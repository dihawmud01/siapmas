<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->delete();

        $faker = Faker::create();

        \DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'gender' => 'male',
                'nim' => '21102122',
                'img' => 'waduh.jpeg',
                'address' => 'Banyumas',
                'place_of_birth' => 'Banyumas',
                'date_of_birth' => '2003-07-15',
                'highschool' => 'SMA Banyumas',
                'grad_year' => '2008',
                'bachelor_year' => '2012',
                'phone' => '081234567890',
                'role_id' => 1,
                'bio' => 'Super Admin Account',
                'username' => 'superadmin',
                'slug' => 'superadmin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'check' => true,
                'pac_id' => 1,
                'cadre_level' => 'Makesta',
                'makesta_year' => '2021',
                'lakmud_year' => null,
                'lakut_year' => null,
                'latinpel_year' => null,
                'informal' => '9',
                'nonformal' => '5',
            ],
            [
                'name' => 'Admin PC',
                'gender' => 'female',
                'nim' => '21100003',
                'img' => 'waduh.jpeg',
                'address' => 'Purwokerto',
                'place_of_birth' => 'Purwokerto',
                'date_of_birth' => '1994-07-15',
                'highschool' => 'SMA Purwokerto',
                'grad_year' => '2012',
                'bachelor_year' => '2016',
                'phone' => '081234123456',
                'role_id' => 2,
                'bio' => 'Admin PC Account',
                'username' => 'adminpc',
                'slug' => 'adminpc',
                'email' => 'adminpc@mail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'check' => true,
                'pac_id' => 2,
                'cadre_level' => 'Makesta',
                'makesta_year' => '2021',
                'lakmud_year' => null,
                'lakut_year' => null,
                'latinpel_year' => null,
                'informal' => '9',
                'nonformal' => '5',
            ],
            [
                'name' => 'Admin PAC',
                'gender' => 'female',
                'nim' => '21102123',
                'img' => 'waduh.jpeg',
                'address' => 'Cilacap',
                'place_of_birth' => 'Cilacap',
                'date_of_birth' => '1992-05-10',
                'highschool' => 'SMA Cilacap',
                'grad_year' => '2010',
                'bachelor_year' => '2014',
                'phone' => '081298765432',
                'role_id' => 2,
                'bio' => 'Admin PAC Account',
                'username' => 'adminpac',
                'slug' => 'adminpac',
                'email' => 'adminpac@mail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'check' => true,
                'pac_id' => 3,
                'cadre_level' => 'Makesta',
                'makesta_year' => '2021',
                'lakmud_year' => null,
                'lakut_year' => null,
                'latinpel_year' => null,
                'informal' => '9',
                'nonformal' => '5',
            ],
        ]);

        $users = [];

        for ($i = 0; $i < 50; $i++) {
            $cadreLevel = $faker->randomElement(['Makesta', 'Lakmud', 'Lakut', 'Latinpel']);

            $users[] = [
                'name' => $faker->name,
                'gender' => $faker->randomElement(['male', 'female']),
                'nim' => $faker->unique()->numerify('2110####'),
                'img' => 'waduh.jpeg',
                'address' => $faker->address,
                'boarding_school' => $faker->word,
                'place_of_birth' => $faker->city,
                'date_of_birth' => $faker->date(),
                'highschool' => $faker->company,
                'grad_year' => $faker->year,
                'bachelor_year' => $faker->year,
                'phone' => $faker->unique()->numerify('08##########'),
                'role_id' => $faker->numberBetween(1, 4),
                'bio' => $faker->sentence,
                'username' => $faker->userName,
                'slug' => Str::slug($faker->userName),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(60),
                'created_at' => now(),
                'updated_at' => now(),
                'check' => $faker->boolean,
                'pac_id' => $faker->numberBetween(1, 29),
                'cadre_level' => $cadreLevel,
                'makesta_year' => $cadreLevel === 'Makesta' ? $faker->numberBetween(2016, 2025) : null,
                'lakmud_year' => $cadreLevel === 'Lakmud' ? $faker->numberBetween(2016, 2025) : null,
                'lakut_year' => $cadreLevel === 'Lakut' ? $faker->numberBetween(2016, 2025) : null,
                'latinpel_year' => $cadreLevel === 'Latinpel' ? $faker->numberBetween(2016, 2025) : null,
                'informal' => strval(rand(1, 9)),
                'nonformal' => strval(rand(1, 9)),
            ];
        }

        \DB::table('users')->insert($users);
    }
}
