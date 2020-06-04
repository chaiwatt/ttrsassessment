<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPlanFeeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_plan_fee_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_plan_id');
            $table->foreign('business_plan_id')->references('id')->on('business_plans')->onDelete('cascade');
            $table->char('invoiceno',20);
            $table->unsignedBigInteger('fee_type_id')->default(1);
            $table->unsignedBigInteger('payment_status_id')->default(1);
            $table->unsignedBigInteger('bank_account_id')->default(1);
            $table->unsignedBigInteger('payment_type_id')->default(1);
            $table->date('transferdate')->nullable();
            $table->char('transfertime',20)->nullable();
            $table->string('note',250)->nullable();
            $table->string('attachment',250)->nullable();
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
        Schema::dropIfExists('business_plan_fee_transactions');
    }
}
