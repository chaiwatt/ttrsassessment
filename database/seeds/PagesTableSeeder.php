<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feature_images')->insert([
            [
                'name' => 'assets/landing2/images/features/default.png'
            ],
            [
                'name' => 'assets/landing2/images/features/default.png'
            ],
            [
                'name' => 'assets/landing2/images/features/default.png'
            ]
        ]);
        DB::table('feature_image_thumbnails')->insert([
            [
                'name' => 'assets/landing2/images/features/thumbdefault.png'
            ],
            [
                'name' => 'assets/landing2/images/features/thumbdefault.png'
            ],
            [
                'name' => 'assets/landing2/images/features/thumbdefault.png'
            ]
        ]);

        DB::table('pages')->insert([
            [
                'page_category_id' => 1,
                'page_status_id' => 1,
                'name' => 'ข่าวที่ 1',
                'slug' => 'ข่าวที่-1',
                'header' => 'Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'feature_image_id' => 1,
                'feature_image_thumbnail_id' => 1,
                'user_id' => 1,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'page_category_id' => 1,
                'page_status_id' => 1,
                'name' => 'ข่าวที่ 2',
                'slug' => 'ข่าวที่-2',
                'header' => 'Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'feature_image_id' => 2,
                'feature_image_thumbnail_id' => 2,
                'user_id' => 1,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ],
            [
                'page_category_id' => 1,
                'page_status_id' => 1,
                'name' => 'ข่าวที่ 3',
                'slug' => 'ข่าวที่-3',
                'header' => 'Do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
                'content' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?',
                'feature_image_id' => 3,
                'feature_image_thumbnail_id' => 3,
                'user_id' => 1,
                'created_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString(),
                'updated_at' => Carbon::now(new DateTimeZone('Asia/Bangkok'))->toDateTimeString()
            ]
        ]);
        DB::table('page_tags')->insert([
            [
                'page_id' => 1,
                'tag_id' => 1
            ],
            [
                'page_id' => 2,
                'tag_id' => 1
            ],
            [
                'page_id' => 3,
                'tag_id' => 1
            ]
        ]);
    }
}
