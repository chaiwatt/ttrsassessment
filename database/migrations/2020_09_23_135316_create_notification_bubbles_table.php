<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationBubblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_bubbles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->unsignedBigInteger('notification_category_id');
            $table->unsignedBigInteger('notification_sub_category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('target_user_id');
            $table->char('status',1)->default('0');
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
        Schema::dropIfExists('notification_bubbles');
    }
}
