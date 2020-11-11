<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyEmploysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_employs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('full_tbp_id')->nullable();
            $table->unsignedBigInteger('prefix_id')->nullable();
            $table->string('name',120)->nullable();
            $table->string('lastname',120)->nullable();
            $table->unsignedBigInteger('employ_position_id')->nullable();
            $table->string('phone',12)->nullable();
            $table->string('workphone',12)->nullable();
            $table->string('email',120)->nullable();
            $table->unsignedBigInteger('stockholder_id')->defualt('1');
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
        Schema::dropIfExists('company_employs');
    }
}
