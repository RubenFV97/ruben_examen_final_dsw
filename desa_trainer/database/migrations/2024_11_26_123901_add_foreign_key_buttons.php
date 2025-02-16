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
        Schema::table('buttons', function (Blueprint $table) {
        $table->foreign('desa_trainer_id')->references('id')->on('desa_trainer');
        $table->foreign('instruction_id')->references('id')->on('instructions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buttons', function (Blueprint $table) {
            $table->dropForeign(['desa_trainer_id']);
            $table->dropForeign(['instruction_id']);
        });
    }
    
};
