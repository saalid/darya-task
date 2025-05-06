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
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->float('high');
            $table->float('low');
            $table->string('weather');
            $table->timestamp('sunrise');
            $table->timestamp('sunset');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
