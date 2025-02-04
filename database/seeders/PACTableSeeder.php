<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PACTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pac')->delete();

        \DB::table('pac')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'pac' => 'BATURRADEN',
                    'slug' => 'baturraden',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            1 =>
                array(
                    'id' => 2,
                    'pac' => 'CILONGOK',
                    'slug' => 'cilongok',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            2 =>
                array(
                    'id' => 3,
                    'pac' => 'KEDUNGBANTENG',
                    'slug' => 'kedungbanteng',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            3 =>
                array(
                    'id' => 4,
                    'pac' => 'KARANGLEWAS',
                    'slug' => 'karanglewas',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            4 =>
                array(
                    'id' => 5,
                    'pac' => 'PURWOJATI',
                    'slug' => 'purwojati',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            5 =>
                array(
                    'id' => 6,
                    'pac' => 'PURWOKERTO BARAT',
                    'slug' => 'purwokerto-barat',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            6 =>
                array(
                    'id' => 7,
                    'pac' => 'PURWOKERTO TIMUR',
                    'slug' => 'purwokerto-timur',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            7 =>
                array(
                    'id' => 8,
                    'pac' => 'PURWOKERTO UTARA',
                    'slug' => 'purwokerto-utara',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            8 =>
                array(
                    'id' => 9,
                    'pac' => 'PURWOKERTO SELATAN',
                    'slug' => 'purwokerto-selatan',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            9 =>
                array(
                    'id' => 10,
                    'pac' => 'SUMBANG',
                    'slug' => 'sumbang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            10 =>
                array(
                    'id' => 11,
                    'pac' => 'SOKARAJA',
                    'slug' => 'sokaraja',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            11 =>
                array(
                    'id' => 12,
                    'pac' => 'KEMBARAN',
                    'slug' => 'kembaran',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            12 =>
                array(
                    'id' => 13,
                    'pac' => 'TAMBAK',
                    'slug' => 'tambak',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            13 =>
                array(
                    'id' => 14,
                    'pac' => 'SOMAGEDE',
                    'slug' => 'somagede',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            14 =>
                array(
                    'id' => 15,
                    'pac' => 'BANYUMAS',
                    'slug' => 'banyumas',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            15 =>
                array(
                    'id' => 16,
                    'pac' => 'KEMRANJEN',
                    'slug' => 'kemranjen',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            16 =>
                array(
                    'id' => 17,
                    'pac' => 'GUMELAR',
                    'slug' => 'gumelar',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            17 =>
                array(
                    'id' => 18,
                    'pac' => 'AJIBARANG',
                    'slug' => 'ajibarang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            18 =>
                array(
                    'id' => 19,
                    'pac' => 'PEKUNCEN',
                    'slug' => 'pekuncen',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            19 =>
                array(
                    'id' => 20,
                    'pac' => 'WANGON',
                    'slug' => 'wangon',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            20 =>
                array(
                    'id' => 21,
                    'pac' => 'RAWALO',
                    'slug' => 'rawalo',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            21 =>
                array(
                    'id' => 22,
                    'pac' => 'JATILAWANG',
                    'slug' => 'jatilawang',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            22 =>
                array(
                    'id' => 23,
                    'pac' => 'KEBASEN',
                    'slug' => 'kebasen',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            23 =>
                array(
                    'id' => 24,
                    'pac' => 'PATIKRAJA',
                    'slug' => 'patikraja',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            24 =>
                array(
                    'id' => 25,
                    'pac' => 'KALIBAGOR',
                    'slug' => 'kalibagor',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            25 =>
                array(
                    'id' => 26,
                    'pac' => 'LUMBIR',
                    'slug' => 'lumbir',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            26 =>
                array(
                    'id' => 27,
                    'pac' => 'SUMPIUH',
                    'slug' => 'sumpiuh',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            27 =>
                array(
                    'id' => 28,
                    'pac' => 'KOMISARIAT UNU PURWOKERTO',
                    'slug' => 'unu',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
            28 =>
                array(
                    'id' => 29,
                    'pac' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
                    'slug' => 'uin-saizu',
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
        ));
    }
}
