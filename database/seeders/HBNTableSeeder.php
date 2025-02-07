<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HBNTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('hbn')->delete();

        \DB::table('hbn')->insert([
            0 => [
                'id' => 5,
                'title' => 'Hari Keluarga',
                'date' => '2023-05-29',
                'description' => 'aw aw aw aw',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            1 => [
                'id' => 6,
                'title' => 'Hari Tanpa Tembakau Sedunia',
                'date' => '2023-05-31',
                'description' => 'aw aw aw aw',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            2 => [
                'id' => 8,
                'title' => 'Idul adhw',
                'date' => '2023-06-29',
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
