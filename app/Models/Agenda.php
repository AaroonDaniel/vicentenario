<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_agenda';

    protected $fillable = [
        'id_evento',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion',
    ];

    // Relación con Eventos
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }
}