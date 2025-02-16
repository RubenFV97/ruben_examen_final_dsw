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
        Schema::table('transitions', function (Blueprint $table) {
            $table->integer('time_seconds')->nullable()->change();
            $table->unsignedBigInteger('desa_button_id')->nullable()->change();
            $table->integer('loop_count')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transitions', function (Blueprint $table) {
            $table->integer('time_seconds')->nullable(false)->change();
            $table->unsignedBigInteger('desa_button_id')->nullable(false)->change();
            $table->integer('loop_count')->nullable(false)->change();
        });
    }
};