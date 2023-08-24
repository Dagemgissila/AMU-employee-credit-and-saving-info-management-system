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
        Schema::create('credit_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id'); // foreign key column
            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade')->oUpdate('cascade');
            $table->float('paid_amount');
            $table->float('principal');
            $table->float('interest');
            $table->float('principal_balance');
            $table->date('paid_month');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_payments');
    }
};
