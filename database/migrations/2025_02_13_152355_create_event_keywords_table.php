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
        Schema::create('keywords', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('event_keywords', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('keyword_id')->constrained()->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_keywords');
        Schema::dropIfExists('keywords');
    }
};
