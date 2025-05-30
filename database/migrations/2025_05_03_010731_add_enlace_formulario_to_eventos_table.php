<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->string('enlaceFormulario', 255)
                ->nullable()
                ->comment('URL del formulario de inscripción')
                  ->after('departamento'); // esto posiciona la nueva columna después de 'departamento'
        });
    }

    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn('enlaceFormulario');
        });
    }
};
