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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->longText('image')->nullable(); // Column to store image data, cannot be null
            $table->string('full_name'); // Column to store the full name
            $table->string('designation'); // Column to store the designation
            $table->json('social_links')->nullable(); // Column to store social links in an array format
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
