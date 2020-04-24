<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisteredCapitalTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registered_capital_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->comment('ประเภทการจดทะเบียน เช่น ประเภทที่ 1');
            $table->string('detail',150)->comment('คำอธิบาย เช่น ทุนจดทะเบียนไม่ถึง 1 ล้านบาท');
            $table->double('min',15,2)->comment('ทุนจดทะเบียนต่ำสุด');
            $table->double('max',15,2)->comment('ทุนจดทะเบียนสูงสุด');
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
        Schema::dropIfExists('registered_capital_types');
    }
}
