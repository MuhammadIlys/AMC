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
        Schema::create('mocks_user_question_history', function (Blueprint $table) {
            $table->id('question_history_id'); // Auto-incremental primary key
            $table->unsignedBigInteger('user_mocks_id');
            $table->unsignedBigInteger('question_id');
            $table->string('choose_option');
            $table->string('question_status');
            $table->string('question_type');
            $table->string('time_spent');

            // Foreign key constraints
            $table->foreign('user_mocks_id')->references('user_mocks_id')->on('mocks_user_test_history')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('question')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mocks_user_question_history');
    }
};
