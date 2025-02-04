<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->delete();

        \DB::table('tags')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title' => 'pc-ipnu-ippnu-banyumas',
                    'slug' => 'pc-ipnu-ippnu-banyumas',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
        ));
    }
}
