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
        Schema::create('students', function (Blueprint $table) {
            // ID , code , name , faculty_id , specialized_id , phone , birthday , gender , class_id , gmail 
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->string('phone');
            $table->date('birthday');
            $table->string('gmail');
            $table->string('image');
            $table->enum('gender', ['Nam', 'Nữ']);

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
