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
        Schema::create('desa_trainer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('model');
            $table->text('description');
            $table->string('image');
            $table->json('settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa_trainer');
    }
};
