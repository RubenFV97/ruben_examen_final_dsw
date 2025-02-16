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
        Schema::create('desa_buttons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_trainer_id');
            $table->unsignedBigInteger('instructions_id')->nullable();
            $table->string('label');
            $table->json('cordinate');
            $table->string('color');
            $table->boolean('is_blinking')->default(false);
            $table->timestamps();

            // Asegúrate de que los nombres de tablas son correctos
            $table->foreign('instructions_id')->references('id')->on('instructions')->onDelete('cascade');
            $table->foreign('desa_trainer_id')->references('id')->on('desa_trainer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa_buttons');
    }
};
