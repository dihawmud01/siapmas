<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NationalDaysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('national_days')->delete();

        \DB::table('national_days')->insert(array (
            0 =>
            array (
                'id' => 5,
                'title' => 'Hari Keluarga',
                'date' => '2023-05-29',
                'description' => 'aw aw aw aw',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            1 =>
            array (
                'id' => 6,
                'title' => 'Hari Tanpa Tembakau Sedunia',
                'date' => '2023-05-31',
                'description' => 'aw aw aw aw',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
            2 =>
            array (
                'id' => 8,
                'title' => 'Idul adhw',
                'date' => '2023-06-29',
                'description' => NULL,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ),
        ));


    }
}
