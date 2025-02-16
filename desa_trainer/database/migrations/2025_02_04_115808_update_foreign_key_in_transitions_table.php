<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transitions', function (Blueprint $table) {
            $table->dropForeign('transitions_desa_button_id_foreign'); 
        });

        Schema::table('transitions', function (Blueprint $table) {
            $table->foreign('desa_button_id')
                  ->references('id')
                  ->on('desa_buttons') 
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }


    public function down()
    {

        Schema::table('transitions', function (Blueprint $table) {
            $table->dropForeign('transitions_desa_button_id_foreign');
        });

        Schema::table('transitions', function (Blueprint $table) {
            $table->foreign('desa_button_id')
                  ->references('id')
                  ->on('buttons')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
};
