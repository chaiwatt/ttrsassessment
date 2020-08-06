<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryGroupByIsicDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_group_by_isic_d_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('industry_group_by_isic_c_id')->nullable();
            $table->string('name',150);
            $table->string('code',150);
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
        Schema::dropIfExists('industry_group_by_isic_d_s');
    }
}
