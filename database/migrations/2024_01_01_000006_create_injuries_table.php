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
        Schema::create('injuries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('body_part');
            $table->enum('severity', ['minor', 'moderate', 'major', 'severe'])->default('minor');
            $table->enum('type', ['strain', 'sprain', 'bruise', 'cut', 'fracture', 'dislocation', 'other'])->default('other');
            $table->date('injury_date');
            $table->date('expected_recovery_date')->nullable();
            $table->date('actual_recovery_date')->nullable();
            $table->enum('status', ['active', 'recovering', 'healed', 'chronic'])->default('active');
            $table->text('treatment_notes')->nullable();
            $table->json('affected_activities')->nullable()->comment('Activities to avoid/modify');
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index('injury_date');
            $table->index('body_part');
            $table->index('severity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('injuries');
    }
};