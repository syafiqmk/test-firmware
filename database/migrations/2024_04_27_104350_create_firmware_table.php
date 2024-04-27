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
        Schema::create('firmware', function (Blueprint $table) {
            $table->id();
            $table->string("series", 50);
            $table->text("file");
            $table->foreignId("category_id")->constrained("device_categories");
            $table->foreignId("brand_id")->constrained("brands");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmware');
    }
};
