<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id(); // Auto-generated ID
        $table->string('parent_name')->nullable();
        $table->string('student_name');
        $table->integer('age');
        $table->string('program'); // e.g., 'premium', 'standard'
        $table->string('phone');
        $table->string('email');
        $table->string('status')->default('pending'); // Default status is 'pending'
        $table->timestamps(); // Creates 'created_at' and 'updated_at' automatically
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
