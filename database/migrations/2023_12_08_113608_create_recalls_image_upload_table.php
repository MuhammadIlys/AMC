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
        Schema::create('recalls_image_upload', function (Blueprint $table) {

            $table->id('image_id');
            $table->string('question_tracking_id');
            $table->string('hyper_link_text');
            $table->string('image_path');
            $table->string('image_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recalls_image_upload');
    }
};
