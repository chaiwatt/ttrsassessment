<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('addresstype',150)->nullable();
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
        Schema::dropIfExists('company_addresses');
    }
}
