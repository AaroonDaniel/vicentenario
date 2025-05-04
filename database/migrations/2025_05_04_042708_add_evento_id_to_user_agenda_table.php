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
        //Schema::table('user_agenda', function (Blueprint $table) {
            
        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('user_agenda', function (Blueprint $table) {
            $table->dropColumn('evento_id');
        });
    }
};
