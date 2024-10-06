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
        Schema::create('milestone_month_range', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->constrained()->onDelete('cascade'); // Foreign key to Milestones
            $table->foreignId('month_range_id')->constrained()->onDelete('cascade'); // Foreign key to MonthRanges
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestone_month_range');
    }
};
