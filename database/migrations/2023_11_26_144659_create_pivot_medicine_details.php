<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pharmacy_invoice_id')->references('id')->on('pharmacy_invoices')->onDelete('cascade');
            $table->foreignId('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->integer('Qty');
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
        Schema::dropIfExists('medicine_details');
    }
};
