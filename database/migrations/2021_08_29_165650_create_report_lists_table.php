<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_lists', function (Blueprint $table) {
            $table->id();
            $table->char('order',2)->nullable();
            $table->char('reporttype',1)->nullable();
            $table->string('reportname',250)->nullable();
            $table->string('reportroute',250)->nullable();
            $table->string('icon',100)->nullable();
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
        Schema::dropIfExists('report_lists');
    }
}
