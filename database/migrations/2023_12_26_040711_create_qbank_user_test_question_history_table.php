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
        Schema::create('qbank_user_test_question_history', function (Blueprint $table) {
            $table->id('question_history_id'); // Auto-incremental primary key
            $table->unsignedBigInteger('user_test_id');
            $table->unsignedBigInteger('qbank_question_id');
            $table->string('choose_option')->nullable();
            $table->string('question_status')->nullable();
            $table->string('time_spent')->nullable();

            // Foreign key constraints
            $table->foreign('user_test_id')->references('user_test_id')->on('qbank_user_tests')->onDelete('cascade');
            $table->foreign('qbank_question_id')->references('qbank_question_id')->on('qbank_questions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qbank_user_test_question_history');
    }
};
