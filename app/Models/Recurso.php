<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    // Clave primaria personalizada
    protected $primaryKey = 'id_recurso';

    // Atributos que pueden ser asignados masivamente
    protected $fillable = [
        'id_evento',
        'nombre',
        'descripcion',
    ];

    // Relación inversa uno a muchos con Eventos
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }
}