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
        Schema::table('transitions', function (Blueprint $table) {
            $table->foreign('from_instruction_id')->references('id')->on('instructions');
            $table->foreign('to_instruction_id')->references('id')->on('instructions');
            $table->foreign('desa_button_id')->references('id')->on('buttons');
            });
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('transitions', function (Blueprint $table) {
                $table->dropForeign(['from_instruction_id']);
                $table->dropForeign(['to_instruction_id']);
                $table->dropForeign(['desa_button_id']);
            });
        }
        
    };
    