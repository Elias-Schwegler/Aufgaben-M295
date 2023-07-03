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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname'); // first name of the person making the reservation
            $table->string('lastname'); // last name of the person making the reservation
            $table->string('note')->nullable(); // optional note
            $table->date('date'); // date of the reservation
            $table->integer('nights'); // number of nights for the reservation
            $table->decimal('room_temperature', 5, 2); // preferred room temperature
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
