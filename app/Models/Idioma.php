<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_idioma';

    // Especificar el nombre de la tabla
    protected $table = 'idiomas';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'id_etnia',
        'nombre',
        'descripcion',
    ];

    // Relaciones
    public function etnia()
    {
        return $this->belongsTo(Etnia::class, 'id_etnia');
    }

    // Relación muchos a muchos con Cultura
    public function culturas()
    {
        return $this->belongsToMany(Cultura::class, 'idiomas_culturas', 'id_idioma', 'id_cultura')
                    ->withPivot('descripcion') // Incluye la columna adicional
                    ->withTimestamps();
    }
}