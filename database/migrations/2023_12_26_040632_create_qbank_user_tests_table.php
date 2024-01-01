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
        Schema::create('qbank_user_tests', function (Blueprint $table) {
            $table->id('user_test_id'); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('qbank_id'); // Foreign key for test
            $table->integer('marked')->nullable();
            $table->integer('correct')->nullable();
            $table->integer('incorrect')->nullable();
            $table->integer('omitted')->nullable();
            $table->decimal('perscent', 5, 2)->nullable(); // Assuming perscent is a decimal field

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('qbank_id')->references('qbank_id')->on('qbank_qbanks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qbank_user_tests');
    }
};
