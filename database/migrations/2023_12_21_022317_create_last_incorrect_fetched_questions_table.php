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
        Schema::create('last_incorrect_fetched_questions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('qbank_system_id');
            $table->unsignedBigInteger('qbank_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('last_fetched_question_id')->nullable();
            $table->timestamps();

            $table->foreign('qbank_system_id')->references('qbank_system_id')->on('qbank_systems')->onDelete('cascade');
            $table->foreign('qbank_id')->references('qbank_id')->on('qbank_qbanks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('last_incorrect_fetched_questions');
    }
};
