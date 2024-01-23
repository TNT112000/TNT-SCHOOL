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

        Schema::create('teachers', function (Blueprint $table) {
            // ID ,  code , name , phone , gmail , faculty_id , image , birthday ,  gender
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('phone');
            $table->string('image');
            $table->date('birthday');
            $table->string('gmail');
            $table->enum('gender', ['Nam', 'Nữ']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
