<?php

use Illuminate\Database\Seeder;

class MessageBoxAttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('message_box_attachments')->insert([
            [
                'message_box_id' => 1,
                'name' => "file1.jpg",
                'attachment' => "storage/uploads/attachment/message/file1.jpg"
            ],
            [
                'message_box_id' => 2,
                'name' => "file2.pdf",
                'attachment' => "storage/uploads/attachment/message/file2.pdf"
            ],
            [
                'message_box_id' => 2,
                'name' => "file1.png",
                'attachment' => "file1",
                'attachment' => "storage/uploads/attachment/message/file1.png"
            ]
        ]);
    }
}
