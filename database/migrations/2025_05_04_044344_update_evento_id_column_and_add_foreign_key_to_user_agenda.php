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
        Schema::table('user_agenda', function (Blueprint $table) {
            $table->unsignedBigInteger('evento_id')->nullable()->change();
        
            $table->foreign('evento_id')
                ->references('id_evento') // 👈 aquí está el cambio
                ->on('eventos')
                ->onDelete('set null');
        });
        
    }

    public function down()
    {
        Schema::table('user_agenda', function (Blueprint $table) {
            $table->dropForeign(['evento_id']);
        });
    }

};
