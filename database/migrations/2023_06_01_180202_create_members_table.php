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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // foreign key column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->float('saving_percent');
            $table->bigInteger('bank_account');
            $table->string('phone_number');
            $table->float('salary');
            $table->string('campus');
            $table->string('colleage')->nullable();
            $table->string('sex');
            $table->string('martial_status');
            $table->datetime('registered_date');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
