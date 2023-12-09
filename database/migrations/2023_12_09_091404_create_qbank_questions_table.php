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
        Schema::create('qbank_questions', function (Blueprint $table) {
            $table->id('qbank_question_id'); // Use 'id' as the default primary key column
            $table->unsignedBigInteger('qbank_id');
            $table->unsignedBigInteger('qbank_system_id');
            $table->unsignedBigInteger('question_track_id');
            $table->longText('question_text');
            $table->longText('option1');
            $table->longText('option2');
            $table->longText('option3');
            $table->longText('option4');
            $table->longText('option5');
            $table->unsignedBigInteger('correct_option');
            $table->longText('question_explanation');

            // Foreign key relationships
            $table->foreign('qbank_id')->references('qbank_id')->on('qbank_qbanks')->onDelete('cascade');
            $table->foreign('qbank_system_id')->references('qbank_system_id')->on('qbank_systems')->onDelete('cascade');

            $table->timestamps(); // Adds created_at and updated_at columns

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qbank_questions');
    }
};
