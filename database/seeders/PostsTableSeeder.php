<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('posts')->delete();

        \DB::table('posts')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'title' => 'Lama Tak Terdengar, PC IPNU IPPNU Banyumas PAC Baturraden Kembali Melaksanakan Diskusi Senja Di Tempat Tak Terduga',
                    'slug' => 'lama-tak-terdengar-pc-ipnu-ippnu-banyumas-pac-baturraden-kembali-melaksanakan-diskusi-senja-di-tempat-tak-terduga',
                    'content' => '<p><strong>PC IPNU IPPNU Banyumas PAC Baturraden</strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at elementum nibh. Nunc vel risus felis. Integer sit amet ex id leo imperdiet porta. Maecenas neque nulla, aliquet ut tincidunt non, sodales in enim. Nam aliquet convallis arcu, sed vehicula elit blandit vel. Mauris commodo eu ipsum ac fermentum. In in lorem eleifend, ornare orci non, imperdiet ligula. Sed non dictum massa. Ut ac nibh eleifend, posuere arcu nec, posuere nibh. In consequat nisi in dolor efficitur, sit amet tristique ante pharetra. Quisque laoreet odio et maximus molestie. Vestibulum tempus, sapien et ullamcorper feugiat, ex dolor pretium justo, porttitor dapibus tellus ex et lorem. Maecenas suscipit lectus eu pellentesque accumsan. Donec non est rhoncus, congue lacus vitae, ornare nibh. Vestibulum vitae fringilla dolor, sit amet convallis nunc.</p>',
                    'images' => 'blog_-1685008925.jpeg',
                    'category_id' => 1,
                    'user_id' => 1,
                    'views' => 116,
                    'active' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                ),
        ));
    }
}
