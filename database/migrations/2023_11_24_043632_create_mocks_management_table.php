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
        Schema::create('mocks_management', function (Blueprint $table) {

            $table->id('mocks_management_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('test_id');
            // Add any additional pivot columns if needed
            // $table->string('additional_column')->nullable();

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_id')->references('test_id')->on('test')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mocks_management');
    }
};
