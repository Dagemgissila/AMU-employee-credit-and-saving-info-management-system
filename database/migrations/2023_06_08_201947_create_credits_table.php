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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // foreign key column
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->oUpdate('cascade');
            $table->float('credit_amount');
            $table->float('interest_rate');
            $table->float('interest_amount');
            $table->float('total_payment');
            $table->datetime('credit_start');
            $table->datetime('credit_end');
            $table->string('witness1')->nullable();
            $table->string('witness2')->nullable();
            $table->string('witness3')->nullable();
            $table->boolean('credit_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
