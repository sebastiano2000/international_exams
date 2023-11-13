<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('resultCode')->nullable();
            $table->string('paymentToken')->nullable();
            $table->string('paymentId')->nullable();
            $table->string('paidOn')->nullable();
            $table->string('orderReferenceNumber')->nullable();
            $table->string('variable1')->nullable();
            $table->string('variable2')->nullable();
            $table->string('variable3')->nullable();
            $table->string('variable4')->nullable();
            $table->string('variable5')->nullable();
            $table->string('method')->nullable();
            $table->string('administrativeCharge')->nullable();
            $table->string('paid')->nullable();
            $table->string('package_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
