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
            $table->char('vatno',13)->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->char('commercialregnumber',15)->nullable();
            $table->unsignedBigInteger('isic_id')->default(1);
            $table->unsignedBigInteger('isic_sub_id')->default(1);
            $table->char('registeredyear',4)->nullable();
            $table->double('registeredcapital',15,2)->nullable();
            $table->unsignedBigInteger('registeredcapitaltype')->nullable();
            $table->double('paidupcapital',15,2)->nullable();
            $table->date('paidupcapitaldate')->nullable();
            $table->unsignedBigInteger('industry_group_id')->nullable();   
            $table->unsignedBigInteger('business_type_id')->nullable(); 
            $table->string('name',150)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('fax',20)->nullable();
            $table->string('email',200)->nullable();
            // $table->char('housenumber',5)->nullable();
            $table->string('website',150)->nullable();
            // $table->char('soi',5)->nullable();
            // $table->string('street',100)->nullable();
            // $table->unsignedBigInteger('province_id')->nullable();
            // $table->unsignedBigInteger('amphur_id')->nullable();
            // $table->unsignedBigInteger('tambol_id')->nullable();
            // $table->string('postalcode',10)->nullable();
            // $table->string('lat',50)->nullable();
            // $table->string('lng',50)->nullable();
            // $table->char('factoryhousenumber',5)->nullable();
            // $table->string('factoryaddress',150)->nullable();
            // $table->char('factorysoi',5)->nullable();
            // $table->string('factorystreet',100)->nullable();
            // $table->unsignedBigInteger('factoryprovince_id')->nullable();
            // $table->unsignedBigInteger('factoryamphur_id')->nullable();
            // $table->unsignedBigInteger('factorytambol_id')->nullable();
            // $table->string('factorypostalcode',10)->nullable();
            // $table->string('factorylat',50)->nullable();
            // $table->string('factorylng',50)->nullable();
            $table->string('logo',250)->nullable();
            $table->string('organizeimg',250)->nullable();
            $table->longText('companyhistory')->nullable();
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
