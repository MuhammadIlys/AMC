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
        Schema::create('mocks_user_attempt', function (Blueprint $table) {

            $table->id('mocks_user_attempt_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('test_id');
            $table->integer('remaining_attempts');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('test_id')->on('test')->onDelete('cascade');


            $table->unique(['user_id', 'test_id']); // Ensure uniqueness for user_id and test_id combination

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mocks_user_attempt');
    }
};
