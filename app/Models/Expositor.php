<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expositor extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_expositor';

    // Especificar el nombre de la tabla
    protected $table = 'expositores';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'especialidad',
        'institucion',
        'contacto',
    ];

    // Relación muchos a muchos con Eventos
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_expositores', 'id_expositor', 'id_evento')
                    ->withPivot('fecha', 'tema') // Incluye las columnas adicionales
                    ->withTimestamps();       // Incluye created_at y updated_at
    }
}