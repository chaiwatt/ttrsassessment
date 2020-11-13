<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name',250)->default('default');
            $table->string('version',10)->default('1.0');
            $table->unsignedBigInteger('ref_assessment_group_id')->nullable();
            $table->unsignedBigInteger('full_tbp_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->char('status',1)->default(0);
            $table->float('percentindex')->default(100);
            $table->float('percentextra')->default(0);
            $table->char('refixstatus',1)->default('0');
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
        Schema::dropIfExists('evs');
    }
}
