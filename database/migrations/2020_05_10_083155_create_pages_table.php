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
            $table->string('featureimg',250); 
            $table->string('featurethumbnail',250); 
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
