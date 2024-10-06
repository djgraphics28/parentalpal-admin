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
        Schema::create('daily_routines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');  // Reference the Child model
            $table->string('routine_title');
            $table->enum('time_of_day', ['Morning', 'Mid-morning', 'Mid-day', 'Afternoon', 'Evening']);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_routines');
    }
};
