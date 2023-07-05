<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('zip');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farms');
    }
}
