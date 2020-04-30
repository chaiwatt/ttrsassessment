<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('registered_capital_type_id')->nullable();
            $table->unsignedBigInteger('industry_group_id')->nullable();   
            $table->unsignedBigInteger('business_type_id')->nullable();
            $table->string('name',150)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('email',200)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
