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
        Schema::create('recalls_questions', function (Blueprint $table) {

            $table->id('recalls_question_id');
            $table->unsignedBigInteger('recalls_year_id');
            $table->unsignedBigInteger('recalls_month_id');
            $table->unsignedBigInteger('recalls_system_id');
            $table->unsignedBigInteger('question_track_id');
            $table->longText('question_text');
            $table->longText('option1');
            $table->longText('option2');
            $table->longText('option3');
            $table->longText('option4');
            $table->longText('option5');
            $table->unsignedInteger('correct_option'); // Integer data type for correct_option
            $table->longText('question_explanation');
            $table->timestamps();

            // Foreign key relationships with ON DELETE CASCADE
            $table->foreign('recalls_year_id')->references('recalls_year_id')->on('recalls_years')->onDelete('cascade');
            $table->foreign('recalls_month_id')->references('recalls_month_id')->on('recalls_months')->onDelete('cascade');
            $table->foreign('recalls_system_id')->references('recalls_system_id')->on('recalls_systems')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recalls_questions');
    }
};
