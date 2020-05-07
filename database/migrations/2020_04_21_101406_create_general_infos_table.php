<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_infos', function (Blueprint $table) {
            $table->id();
            $table->string('company',150)->comment('ชื่อหน่วยงาน เช่น สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ');
            $table->string('logo',250)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('fax',50)->nullable();
            $table->string('email',200)->nullable();
            $table->string('address',150)->nullable();
            $table->unsignedBigInteger('province_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol_id')->default(367);  //คลองหนึ่ง
            $table->string('client_id',250);
            $table->string('client_secret',250);
            $table->string('thsmsuser',250)->nullable();
            $table->string('thsmspass',250)->nullable();
            $table->unsignedBigInteger('verify_status_id')->default(1);
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
        Schema::dropIfExists('general_infos');
    }
}
