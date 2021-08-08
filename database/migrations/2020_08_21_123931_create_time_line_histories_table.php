<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeLineHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_line_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->unsignedBigInteger('mini_tbp_id');
            $table->text('details')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('viewer')->nullable();
            // $table->char('status',1)->default('0');
            $table->char('message_type',1)->default('1')->comment('1 = mini 2 = full 3 = อื่นๆ');;
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
        Schema::dropIfExists('time_line_histories');
    }
}
