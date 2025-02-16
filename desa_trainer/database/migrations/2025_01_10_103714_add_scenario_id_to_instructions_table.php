<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->unsignedBigInteger('scenario_id')->nullable(); // O usa el tipo adecuado para tu escenario
        });
    }
    
    public function down()
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->dropColumn('scenario_id');
        });
    }    
};
