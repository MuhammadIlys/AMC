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
        Schema::create('question', function (Blueprint $table) {
            $table->id('question_id');
            $table->unsignedBigInteger('question_track_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('test_id')->nullable();
            $table->text('question_text');
            $table->text('option1');
            $table->text('option2');
            $table->text('option3');
            $table->text('option4');
            $table->text('option5');
            $table->unsignedTinyInteger('correct_option');
            $table->string('question_type', 255); // Adjust the length as needed
            $table->text('question_explanation');

            $table->timestamps();

            $table->foreign('subject_id')->references('subject_id')->on('subject');
            $table->foreign('speciality_id')->references('speciality_id')->on('speciality');
            $table->foreign('topic_id')->references('topic_id')->on('topic');
            $table->foreign('test_id')->references('test_id')->on('test');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question');
    }
};
