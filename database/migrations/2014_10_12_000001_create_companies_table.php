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
            $table->char('vatno',13)->unique()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('registered_capital_type_id')->nullable();
            $table->unsignedBigInteger('industry_group_id')->nullable();   
            $table->unsignedBigInteger('business_type_id')->nullable();
            $table->string('name',150)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('email',200)->nullable();
            $table->char('housenumber',5)->nullable();
            $table->string('address',150)->nullable();
            $table->char('soi',5)->nullable();
            $table->string('street',100)->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('amphur_id')->nullable();
            $table->unsignedBigInteger('tambol_id')->nullable();
            $table->string('postalcode',10)->nullable();
            $table->string('lat',50)->nullable();
            $table->string('lng',50)->nullable();
            $table->string('logo',250)->nullable();
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
