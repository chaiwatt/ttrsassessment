<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name',250)->comment('กลุ่มธุรกิจ เช่น เกษตรและอุตสาหกรรมอาหาร');
            $table->string('nameth',250)->nullable();
            $table->string('nameeng',250)->nullable();
            $table->char('companybelong',5)->default(0);
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
        Schema::dropIfExists('industry_groups');
    }
}
