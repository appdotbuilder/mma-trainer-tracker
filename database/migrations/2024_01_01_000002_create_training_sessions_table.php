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
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_block_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('scheduled_at');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->integer('duration_minutes')->nullable()->comment('Actual session duration');
            $table->enum('type', ['striking', 'grappling', 'conditioning', 'technique', 'sparring', 'mixed'])->default('mixed');
            $table->enum('intensity', ['low', 'moderate', 'high', 'max'])->default('moderate');
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled', 'missed'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'scheduled_at']);
            $table->index('training_block_id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};