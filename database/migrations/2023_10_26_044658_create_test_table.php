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
        Schema::create('test', function (Blueprint $table) {

            $table->id('test_id'); // Auto-incremental primary key
            $table->string('test_name');
            $table->decimal('total_mark', 8, 2); // Assuming a decimal type for total_mark
            $table->decimal('passing_score', 8, 2); // Assuming a decimal type for passing_score
            $table->unsignedInteger('allow_attempt');
            $table->enum('test_status', ['active', 'inactive']); // Enum with possible values

            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test');
    }
};
