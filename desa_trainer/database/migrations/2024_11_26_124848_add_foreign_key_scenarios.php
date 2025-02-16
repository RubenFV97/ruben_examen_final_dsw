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
        Schema::table('scenarios', function (Blueprint $table) {
            $table->foreign('desatrainer_id')->references('id')->on('desa_trainer');
            });
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('scenarios', function (Blueprint $table) {
                $table->dropForeign(['desatrainer_id']);
              
            });
        }
        
    };
    