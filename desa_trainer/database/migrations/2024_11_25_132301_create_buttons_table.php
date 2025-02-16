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
        Schema::create('buttons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('desa_trainer_id');
           // $table->foreign('desa_trainer_id')->references('id')->on('desa_trainer');
            $table->unsignedBigInteger('instruction_id');
           // $table->foreign('instruction_id')->references('id')->on('instructions');
            $table->string('label');
            $table->json('cordinate');
            $table->string('color');
            $table->boolean('is_blinking');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buttons');
    }
};
