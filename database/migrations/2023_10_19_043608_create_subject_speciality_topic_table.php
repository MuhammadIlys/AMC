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
        Schema::create('subject_speciality_topic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('speciality_id');
            $table->timestamps();

            $table->foreign('topic_id')->references('topic_id')->on('topic');
            $table->foreign('subject_id')->references('subject_id')->on('subject');
            $table->foreign('speciality_id')->references('speciality_id')->on('speciality');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_speciality_topic');
    }
};
