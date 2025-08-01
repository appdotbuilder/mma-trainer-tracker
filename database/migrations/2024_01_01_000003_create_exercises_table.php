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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['striking', 'grappling', 'conditioning', 'technique', 'flexibility'])->default('technique');
            $table->json('muscle_groups')->nullable()->comment('Target muscle groups');
            $table->string('equipment')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('is_custom')->default(false)->comment('User-created exercise');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            $table->index('category');
            $table->index('name');
            $table->index(['is_custom', 'created_by']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};