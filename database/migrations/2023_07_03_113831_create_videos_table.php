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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

# php artisan make: migration create_videos_table
# php artisan migrate
#php artisan migrate:refresh
#or
#php artisan migrate:fresh
#create Model: php artisan make:model <<Book>> -m if migration should be created with it as well
# in env die DB auswählen ...