<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_list')->default(1);
            $table->string('name',250)->nullable();
            $table->string('bg',250)->nullable();
            $table->string('anchore',100)->nullable();
            $table->string('aliasname',100)->nullable();
            $table->string('editurl',250)->nullable();
            $table->char('show',1)->default(1);
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('home_page_sections');
    }
}
