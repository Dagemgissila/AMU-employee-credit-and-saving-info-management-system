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
        Schema::create('request_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // foreign key column
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade')->oUpdate('cascade');
            $table->float("request_amount");
            $table->integer("duration_in_month");
            $table->boolean("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_credits');
    }
};
