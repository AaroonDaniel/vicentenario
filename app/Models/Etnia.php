<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etnia extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_etnia';

    // Especificar el nombre de la tabla
    protected $table = 'etnias';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'id_cultura',
        'nombre',
        'ubicacion',
        'poblacion',
    ];

    // Relaciones
    public function cultura()
    {
        return $this->belongsTo(Cultura::class, 'id_cultura');
    }

    public function idiomas()
    {
        return $this->hasMany(Idioma::class, 'id_etnia');
    }

    public function costumbres()
    {
        return $this->hasMany(Costumbre::class, 'id_etnia');
    }
}