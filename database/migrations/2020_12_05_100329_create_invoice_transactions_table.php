<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('mini_tbp_id')->nullable();
            $table->unsignedBigInteger('bank_id');
            $table->string('customer',50)->nullable();
            $table->string('docno',50)->nullable();
            $table->date('issuedate',50)->nullable();
            $table->string('quotationno',50)->nullable();
            $table->string('purchaseorderno',50)->nullable();
            $table->string('saleorderno',50)->nullable();
            $table->string('saleorderdate',50)->nullable();
            $table->string('refno',50)->nullable();
            $table->string('description',50)->nullable();
            $table->double('price',15,2)->default(0);
            $table->double('transferprice',15,2)->default(0);
            $table->date('paymentdate',50)->nullable();
            $table->string('paymenttime',50)->nullable();
            $table->string('billerid',50)->nullable();
            $table->string('branchid',50)->nullable();
            $table->string('servicecode',50)->nullable();
            $table->string('compcode',50)->nullable();
            $table->string('ref1',50)->nullable();
            $table->string('ref2',50)->nullable();
            $table->string('note',250)->nullable();
            $table->string('attachment',250)->nullable();
            $table->char('status',1)->default(0);
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
        Schema::dropIfExists('invoice_transactions');
    }
}
