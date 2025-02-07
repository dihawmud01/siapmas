<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgendasTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('agendas')->truncate();

        \DB::table('agendas')->insert([
            [
                'title' => 'Pelantikan Administrator Komisariat',
                'organizer' => 'KOMISARIAT UNU PURWOKERTO',
                'date' => '2023-05-26T13:00',
                'place' => 'Gd. PascaSarjana Lt 1',
                'category' => 'Formal',
                'total_participants' => '70',
                'target' => 'ya nda tau',
                'evaluation' => 'konsumsi di perbaiki lagi',
                'status' => '1',
                'pamphlet' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Taman Baca',
                'organizer' => 'PAC BATURRADEN',
                'date' => '2023-05-31T16:00',
                'place' => 'Rumput Surga',
                'category' => 'Nonformal',
                'total_participants' => '21',
                'target' => 'ya nda tau',
                'evaluation' => '231',
                'status' => '1',
                'pamphlet' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Harlah PC IPNU IPPNU Banyumas',
                'organizer' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
                'date' => '2023-06-23T00:00',
                'place' => 'Solo',
                'category' => 'Nonformal',
                'total_participants' => null,
                'target' => null,
                'evaluation' => null,
                'status' => '0',
                'pamphlet' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ngecor Jalan',
                'organizer' => 'PAC CILONGOK',
                'date' => '2023-08-23T17:13',
                'place' => 'Jl. Soekarno Hatta',
                'category' => 'Nonformal',
                'total_participants' => null,
                'target' => null,
                'evaluation' => null,
                'status' => '0',
                'pamphlet' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
