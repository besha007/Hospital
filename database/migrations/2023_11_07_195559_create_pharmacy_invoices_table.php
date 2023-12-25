<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('pharmacy_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('doctor_id');
            $table->decimal('Total_before_discount',8,2);
            $table->double('discount_value', 8, 2)->default(0);
            $table->decimal('Total_after_discount',8,2);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->double('total_with_tax', 8, 2)->default(0);
            $table->integer('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pharmacy_invoices');
    }
};
