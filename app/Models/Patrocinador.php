<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrocinador extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_patrocinador';

    // Especificar el nombre de la tabla
    protected $table = 'patrocinadores';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'razon_social',
        'institucion',
    ];

    // Relación muchos a muchos con Evento
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_patrocinadores', 'id_auspiciador', 'id_evento')
                    ->withPivot('fecha', 'monto')
                    ->withTimestamps();
    }
}