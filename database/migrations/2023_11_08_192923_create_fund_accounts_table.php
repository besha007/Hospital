<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('invoice_id')->nullable()->references('id')->on('invoices')->onDelete('cascade');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->onDelete('cascade');
            $table->foreignId('Payment_id')->nullable()->references('id')->on('payment_accounts')->onDelete('cascade');
            $table->foreignId('pharmacy_invoice_id')->nullable()->references('id')->on('pharmacy_invoices')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fund_accounts');
    }
};
