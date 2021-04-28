<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ev_id');
            $table->unsignedBigInteger('criteria_transaction_id');
            $table->foreign('criteria_transaction_id')->references('id')->on('criteria_transactions')->onDelete('cascade');
            $table->unsignedBigInteger('sub_pillar_index_id');
            $table->char('scoretype',1)->default('1');
            $table->char('score',2)->nullable();
            $table->string('comment',250)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('scorings');
    }
}
