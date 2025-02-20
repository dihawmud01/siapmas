<?php

namespace Database\Seeders;

use App\Models\Cadre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CadresTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cadres')->truncate();

        Cadre::factory()
            ->count(50)
            ->create();
    }
}
