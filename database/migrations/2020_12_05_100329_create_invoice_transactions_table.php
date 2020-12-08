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
            $table->unsignedBigInteger('bank_id');
            $table->text('customer',50)->nullable();
            $table->text('docno',50)->nullable();
            $table->date('issuedate',50)->nullable();
            $table->text('quotationno',50)->nullable();
            $table->text('purchaseorderno',50)->nullable();
            $table->text('saleorderno',50)->nullable();
            $table->text('saleorderdate',50)->nullable();
            $table->text('refno',50)->nullable();
            $table->text('description',50)->nullable();
            $table->double('price',10,2)->default(0);
            $table->double('transferprice',10,2)->default(0);
            $table->date('paymentdate',50)->nullable();
            $table->text('paymenttime',50)->nullable();
            $table->text('billerid',50)->nullable();
            $table->text('branchid',50)->nullable();
            $table->text('servicecode',50)->nullable();
            $table->text('compcode',50)->nullable();
            $table->text('ref1',50)->nullable();
            $table->text('ref2',50)->nullable();
            $table->text('note',250)->nullable();
            $table->text('attachment',250)->nullable();
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
