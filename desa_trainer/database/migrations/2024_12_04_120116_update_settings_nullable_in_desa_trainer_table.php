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
        Schema::table('desa_trainer', function (Blueprint $table) {
            $table->string('settings')->nullable()->change(); // Hacer que 'settings' sea nullable
        });
    }
    
    public function down()
    {
        Schema::table('desa_trainer', function (Blueprint $table) {
            $table->string('settings')->nullable(false)->change(); // Revertir la columna a no-nullable
        });
    }
    
};