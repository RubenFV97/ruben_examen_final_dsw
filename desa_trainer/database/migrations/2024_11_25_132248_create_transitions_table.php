<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('from_instruction_id');
            // $table->foreign('from_instruction_id')->references('id')->on('instructions');
            $table->unsignedBigInteger('to_instruction_id');
            // $table->foreign('to_instruction_id')->references('id')->on('instructions');
            $table->enum('trigger', ['time', 'user_choice', 'loop']);
            $table->integer('time_seconds');
            $table->unsignedBigInteger('desa_button_id');
            // $table->foreign('desa_button_id')->references('id')->on('buttons');
            $table->integer('loop_count');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transitions');
    }
};
