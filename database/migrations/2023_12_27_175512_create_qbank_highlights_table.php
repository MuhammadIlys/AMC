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
        Schema::create('qbank_highlights', function (Blueprint $table) {
            $table->id('highlight_id');
            $table->unsignedBigInteger('qbank_question_id');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('qbank_id');
            $table->unsignedBigInteger('question_highlight_id');
            $table->Text('highlight_text');
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('qbank_question_id')->references('qbank_question_id')->on('qbank_questions')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('qbank_id')->references('qbank_id')->on('qbank_qbanks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qbank_highlights');
    }
};
