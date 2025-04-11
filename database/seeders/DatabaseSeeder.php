<?php

namespace Database\Seeders;

use App\Models\Historia;
use App\Models\Cultura;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear historias usando el método create

        
        Cultura::create([
            'id_historia' => 7,
            'nombre' => 'Aymara',
            'descripcion' => 'Cultura indígena que ha influido profundamente en la identidad boliviana.',
            'tipo' => 'Indígena',
            'origen' => 'Altiplano boliviano',
        ]);
        Cultura::create([
            'id_historia' => 7,
            'nombre' => 'Quechua',
            'descripcion' => 'Cultura precolombina que se extendió por los Andes bolivianos.',
            'tipo' => 'Indígena',
            'origen' => 'Valles y altiplano',
        ]);
        Cultura::create([
            'id_historia' => 8,
            'nombre' => 'Mestiza',
            'descripcion' => 'Fusión de culturas indígenas y europeas tras la colonización.',
            'tipo' => 'Colonial',
            'origen' => 'Ciudades coloniales como Sucre y Potosí',
        ]);
        Cultura::create([
            'id_historia' => 9,
            'nombre' => 'Chaco',
            'descripcion' => 'Cultura de las tierras bajas de Bolivia, conocida por su biodiversidad.',
            'tipo' => 'Moderna',
            'origen' => 'Región del Chaco',
        ]);
    }
}
