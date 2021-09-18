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
            $table->string('company',150)->default('สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)')->comment('ชื่อหน่วยงาน เช่น สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ');
            $table->string('company_default',150)->default('สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ (สวทช.)')->comment('ชื่อหน่วยงาน เช่น สำนักงานพัฒนาวิทยาศาสตร์และเทคโนโลยีแห่งชาติ');
            $table->string('company_titlebar',150)->default('nstda');
            $table->string('logo',250)->nullable();
            $table->string('logo2',250)->nullable();
            $table->string('phone1',50)->default('0-2564-7000');
            $table->string('phone1_ext',50)->default('1411-1417');
            $table->string('phone1_default',50)->default('0-2564-7000');
            $table->string('phone2',50)->default('0-2564-8000');
            $table->string('phone2_default',50)->default('0-2564-8000');
            $table->string('fax',50)->default('0-2564-7004');
            $table->string('fax_default',50)->default('0-2564-7004');
            $table->string('email',200)->default('ttrs@nstda.or.th');
            $table->string('email_default',200)->default('ttrs@nstda.or.th');
            $table->string('address',150)->default('111 อุทยานวิทยาศาสตร์ประเทศไทย ถนนพหลโยธิน');
            $table->string('address_default',150)->default('111 อุทยานวิทยาศาสตร์ประเทศไทย ถนนพหลโยธิน');
            $table->unsignedBigInteger('province_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol_id')->default(367);  //คลองหนึ่ง
            $table->unsignedBigInteger('province_default_id')->default(4);  //ปทุมธานี
            $table->unsignedBigInteger('amphur_default_id')->default(67);   //คลองหลวง
            $table->unsignedBigInteger('tambol_default_id')->default(367);  //คลองหนึ่ง
            $table->string('workdaytime',250)->default('8.00-16.00');
            $table->string('workdaytime_default',250)->default('8.00-16.00');
            $table->string('facebook',250)->default('https://www.facebook.com/NSTDATHAILAND');
            $table->string('facebook_default',250)->default('https://www.facebook.com/NSTDATHAILAND');
            $table->string('instagram',250)->nullable();
            $table->string('instagram_default',250)->nullable();
            $table->string('youtube',250)->default('https://www.youtube.com/user/nstda');
            $table->string('twitter',250)->default('https://twitter.com/nstdathailand');
            $table->char('showsocialmedia',1)->default('0');
            $table->string('director',250)->default('nstda');
            $table->string('director_default',250)->nullable();
            $table->char('postalcode',5)->default('12120');
            $table->char('postalcode_default',5)->default('12120');
            $table->string('client_id',250);
            $table->string('client_secret',250);
            $table->unsignedBigInteger('layout_style_id')->default(1);  //คลองหนึ่ง
            $table->string('saturdaytime',250)->nullable();
            $table->string('sundaytime',250)->nullable();
            $table->string('thsmsuser',250)->nullable();
            $table->text('thsmspass')->nullable();
            $table->longText('consent')->nullable();
            $table->unsignedBigInteger('social_login_status')->default(1);  //ปิด
            $table->unsignedBigInteger('verify_type_id')->default(1);
            $table->unsignedBigInteger('front_page_status_id')->default(1);
            $table->unsignedBigInteger('front_page_status_default_id')->default(1);
            $table->unsignedBigInteger('verify_expert_status_id')->default(1);
            $table->unsignedBigInteger('verify_expert_default_status_id')->default(1);
            $table->char('watermark',1)->default(1);
            $table->char('watermark_default',1)->default(1);
            $table->char('togglebar',1)->default(1);
            $table->char('invoiceoption',1)->default(2);
            $table->char('notifybolchange',1)->default(1);
            $table->char('invoiceoption_default',1)->default(2);
            $table->unsignedBigInteger('showalert_id')->default(1);
            $table->string('watermarktext',250)->default('เอกสารสำคัญปกปิด (Private & Confidential)');
            $table->unsignedBigInteger('use_invoice_status_id')->default(2);  
            $table->unsignedBigInteger('use_invoice_status_default_id')->default(2); 
            $table->unsignedBigInteger('show_finished_project_id')->default(1);
            $table->char('sendemail',1)->default(1);
            $table->char('showgradeperpillar',1)->default(1);
            $table->char('showgradeperbusinesssize',1)->default(1);
            $table->char('showgradepersection',1)->default(1);
            $table->char('showgradeperbusinesstype',1)->default(1);
            $table->char('showgradeperindustrygroup',1)->default(1);
            $table->char('showgradeperisic',1)->default(1);
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
