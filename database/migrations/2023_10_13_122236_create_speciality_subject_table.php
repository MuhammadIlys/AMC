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
        Schema::create('speciality_subject', function (Blueprint $table) {
            $table->bigIncrements('id'); // Use bigIncrements for auto-incrementing primary key
            $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('subject_id');

            // Define foreign key constraints
            $table->foreign('speciality_id')->references('speciality_id')->on('speciality')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subject')->onDelete('cascade');

            // Automatically manage created_at and updated_at timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speciality_subject');
    }
};
