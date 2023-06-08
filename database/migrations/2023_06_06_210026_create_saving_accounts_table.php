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
        Schema::create('saving_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // foreign key column
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->oUpdate('cascade');
            $table->float('saving_amount')->nullable();
            $table->datetime('saving_month')->default(now());
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_accounts');
    }
};
