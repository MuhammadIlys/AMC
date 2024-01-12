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
        Schema::create('qbank_account_reset', function (Blueprint $table) {

            $table->id('account_reset_id');
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('qbank_id');
            $table->unsignedBigInteger('reset_count');
            $table->Text('reset_type');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('qbank_id')->references('qbank_id')->on('qbank_qbanks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qbank_account_reset');
    }
};
