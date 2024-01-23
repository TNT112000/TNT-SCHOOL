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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('start_day');
            $table->string('end_day');
            $table->string('end_2');
            $table->string('start_2');
            $table->string('end_3');
            $table->string('start_3');
            $table->string('end_4');
            $table->string('start_4');
            $table->string('end_5');
            $table->string('start_5');
            $table->string('end_6');
            $table->string('start_6');
            $table->string('end_7');
            $table->string('start_7');
            $table->string('end_cn');
            $table->string('start_cn');
            $table->foreignId('part_class_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
