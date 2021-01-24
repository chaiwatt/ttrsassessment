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
            $table->string('phone1',50)->nullable();
            $table->string('phone2',50)->nullable();
            $table->string('fax',50)->nullable();
            $table->string('email',200)->nullable();
            $table->string('address',150)->nullable();
            $table->unsignedBigInteger('province_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol_id')->default(367);  //คลองหนึ่ง
            $table->char('postalcode',5)->default('12120');
            $table->string('client_id',250);
            $table->string('client_secret',250);
            $table->string('youtube',250)->nullable();
            $table->string('facebook',250)->nullable();
            $table->string('twitter',250)->nullable();
            $table->string('instagram',250)->nullable();
            $table->string('skype',250)->nullable();
            $table->string('linkedin',250)->nullable();
            $table->unsignedBigInteger('layout_style_id')->default(1);  //คลองหนึ่ง
            $table->string('workdaytime',250)->nullable();
            $table->string('saturdaytime',250)->nullable();
            $table->string('sundaytime',250)->nullable();
            $table->string('director',250)->nullable();
            $table->string('thsmsuser',250)->nullable();
            $table->text('thsmspass')->nullable();
            $table->longText('consent')->nullable();
            $table->unsignedBigInteger('social_login_status')->default(1);  //ปิด
            $table->unsignedBigInteger('verify_type_id')->default(1);
            $table->unsignedBigInteger('front_page_status_id')->default(1);
            $table->unsignedBigInteger('verify_expert_status_id')->default(2);
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
