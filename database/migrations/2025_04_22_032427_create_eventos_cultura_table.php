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
        Schema::create('eventos_cultura', function (Blueprint $table) {
            $table->foreignId('id_evento')
                ->constrained('eventos', 'id_evento')
                ->onDelete('cascade');
            $table->foreignId('id_cultura')
                ->constrained('culturas', 'id_cultura')
                ->onDelete('cascade');

            $table->timestamps();

            $table->primary(['id_evento', 'id_cultura']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_cultura');
    }
};