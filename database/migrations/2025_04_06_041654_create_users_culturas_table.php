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
        Schema::create('users_culturas', function (Blueprint $table) {
            $table->foreignId('user_id') // Tipo: unsignedBigInteger
                  ->constrained('users', 'user_id')
                  ->onDelete('cascade');
            $table->foreignId('id_cultura') // Tipo: unsignedBigInteger
                  ->constrained('culturas', 'id_cultura')
                  ->onDelete('cascade');
            $table->string('nivel_interes')->nullable();
            $table->timestamps();
            $table->primary(['user_id', 'id_cultura']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_culturas');
    }
};