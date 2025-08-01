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
        Schema::create('mma_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_session_id')->constrained()->onDelete('cascade');
            $table->integer('strike_count')->nullable()->comment('Total strikes thrown');
            $table->integer('strikes_landed')->nullable()->comment('Strikes that landed');
            $table->integer('takedown_attempts')->nullable();
            $table->integer('takedowns_successful')->nullable();
            $table->integer('submission_attempts')->nullable();
            $table->integer('submissions_successful')->nullable();
            $table->integer('avg_heart_rate')->nullable()->comment('BPM');
            $table->integer('max_heart_rate')->nullable()->comment('BPM');
            $table->json('heart_rate_zones')->nullable()->comment('Time spent in each HR zone');
            $table->integer('calories_burned')->nullable();
            $table->decimal('distance_covered', 8, 2)->nullable()->comment('Distance in kilometers');
            $table->json('additional_metrics')->nullable()->comment('Custom metrics');
            $table->timestamps();
            
            $table->index('training_session_id');
            $table->index('avg_heart_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mma_metrics');
    }
};