<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->json('amenities')->nullable()->after('sub_category_id');
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('amenities');
        });
    }
};