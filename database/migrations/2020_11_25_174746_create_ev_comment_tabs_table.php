<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvCommentTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ev_comment_tabs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->foreign('ev_id')->references('id')->on('evs')->onDelete('cascade');
            $table->char('stage',1)->default(1);
            $table->char('status',1)->default(1);
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
        Schema::dropIfExists('ev_comment_tabs');
    }
}
