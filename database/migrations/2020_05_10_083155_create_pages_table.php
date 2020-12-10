<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_category_id');
            $table->unsignedBigInteger('page_status_id');
            $table->string('name',150);
            $table->string('slug',150);
            $table->string('header',250);
            $table->longText('content');
            $table->unsignedBigInteger('feature_image_id')->nullable();
            $table->unsignedBigInteger('feature_image_thumbnail_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blogsidebarimage_id')->nullable();
            $table->unsignedBigInteger('bloghomepageimage_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
