<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_category_id');
            $table->foreign('notification_category_id')->references('id')->on('notification_categories')->onDelete('cascade');
            $table->string('name',250);
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
        Schema::dropIfExists('notification_sub_categories');
    }
}
