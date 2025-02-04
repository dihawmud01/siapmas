<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('administrators')->delete();

        \DB::table('administrators')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'images' => 'users.png',
                    'name' => 'Riki Ramdan',
                    'username' => 'rikiramdan',
                    'position' => 'Ketua PC IPNU IPPNU Banyumas',
                    'fb' => NULL,
                    'ig' => NULL,
                    'x' => NULL,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
        ));
    }
}
