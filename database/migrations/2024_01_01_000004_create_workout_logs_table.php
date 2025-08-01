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
        Schema::create('workout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_session_id')->constrained()->onDelete('cascade');
            $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0)->comment('Exercise order in session');
            $table->integer('sets_completed')->default(0);
            $table->integer('target_sets')->nullable();
            $table->json('set_details')->nullable()->comment('Array of set data (reps, weight, duration, etc.)');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['training_session_id', 'order']);
            $table->index('exercise_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_logs');
    }
};