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
        Schema::create('mocks_user_test_history', function (Blueprint $table) {

            $table->id('user_mocks_id'); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('test_id'); // Foreign key for test
            $table->integer('score');
            $table->integer('correct');
            $table->integer('incorrect');
            $table->integer('omitted');
            $table->decimal('perscent', 5, 2); // Assuming perscent is a decimal field

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('test_id')->references('test_id')->on('test');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mocks_user_test_history');
    }
};
