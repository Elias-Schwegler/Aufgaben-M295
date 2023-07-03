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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10); // room number
            $table->string('room_type', 50); // type of the room
            $table->integer('capacity'); // capacity of the room
            $table->decimal('price', 10, 2); // price of the room
            $table->text('description')->nullable(); // optional description of the room
            $table->boolean('is_available')->default(true); // room availability status, default is true (available)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
