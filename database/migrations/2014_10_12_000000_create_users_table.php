<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prefix_id')->default(1);
            $table->string('alter_prefix')->nullable();
            $table->unsignedBigInteger('user_status_id')->default(1);
            // $table->unsignedBigInteger('user_position_id')->default(1);
            $table->char('hid',13)->nullable();
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('user_type_id');
            $table->string('linetoken')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('picture')->nullable();
            $table->string('signature')->nullable();
            $table->string('cover')->nullable();
            $table->string('address',150)->nullable();
            $table->unsignedBigInteger('province_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol_id')->default(367);  //คลองหนึ่ง
            $table->char('postal',5)->nullable();
            $table->string('address1',150)->nullable();
            $table->unsignedBigInteger('province1_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur1_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol1_id')->default(367);  //คลองหนึ่ง
            $table->char('postal1',5)->nullable();
            $table->unsignedBigInteger('verify_type')->default(1);
            $table->unsignedBigInteger('allow_assessment')->default(1);
            $table->unsignedBigInteger('user_group_id')->default(2);
            $table->string('website',150)->nullable();
            $table->string('lat',50)->nullable();
            $table->string('lng',50)->nullable();
            $table->date('otp')->nullable();
            $table->char('isexpert',1)->default(1);
            $table->char('verify_expert',1)->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
