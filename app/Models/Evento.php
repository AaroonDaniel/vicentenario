<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_evento';

    // Especificar el nombre de la tabla
    protected $table = 'eventos';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'tipo',
        'fecha',
        'departamento',
        'imagen_ruta',
        'hora',
        'modalidad',
        'enlace'
    ];
    protected $casts = [
        'fecha' => 'datetime',      // datetime → Carbon con fecha y hora
        // ó si solo necesitas la parte de la fecha sin hora:
        // 'fecha' => 'date',       // date → Carbon con sólo la parte fecha
    ];

    // Relaciones
    

    /**
     * Relación muchos a muchos con Expositores.
     */
    public function expositores()
    {
        return $this->belongsToMany(Expositor::class, 'eventos_expositores', 'id_evento', 'id_expositor')
                    ->withPivot('fecha', 'tema') // Incluye las columnas adicionales
                    ->withTimestamps();       // Incluye created_at y updated_at
    }

    /**
     * Relación muchos a muchos con Patrocinadores.
     */
    public function patrocinadores()
    {
        return $this->belongsToMany(Patrocinador::class, 'eventos_patrocinadores', 'id_evento', 'id_auspiciador')
                    ->withPivot('fecha', 'monto')
                    ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con Users (participantes).
     */
    public function participantes()
    {
        return $this->belongsToMany(User::class, 'participantes_eventos', 'id_evento', 'user_id')
                    ->withTimestamps();
    }

    /**
     * Relación uno a muchos con Agendas.
     */
    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'id_evento', 'id_evento');
    }

    /**
     * Relación uno a muchos con Recursos.
     */
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'id_evento', 'id_evento');
    }

    /**
     * Relación uno a muchos con Multimedia.
     */
    public function multimedia()
    {
        return $this->hasMany(Multimedia::class, 'id_evento', 'id_evento');
    }

    /**
     * Relación muchos a muchos con Idiomas.
     */
    public function idiomas()
    {
        return $this->belongsToMany(Idioma::class, 'eventos_idiomas', 'id_evento', 'id_idioma')
                    ->withPivot('nivel_requerido')
                    ->withTimestamps();
    }

    public function culturas()
    {
        return $this->belongsToMany(Cultura::class, 'eventos_cultura', 'id_evento', 'id_cultura');
    }

    public function historias()
    {
        return $this->belongsToMany(Historia::class, 'eventos_historia', 'id_evento', 'id_historia')->withTimestamps();
    }

}