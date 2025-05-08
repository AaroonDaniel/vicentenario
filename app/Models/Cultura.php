<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cultura extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_cultura';

    // Especificar el nombre de la tabla
    protected $table = 'culturas';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'id_historia',
        'nombre',
        'descripcion',
        'tipo',
        'origen',
        'imagen'
    ];

    // Relación inversa uno a muchos con Historia
    public function historia()
    {
        return $this->belongsTo(Historia::class, 'id_historia', 'id_historia');
    }

    public function etnias()
    {
        return $this->hasMany(Etnia::class, 'id_cultura');
    }

    // Relación muchos a muchos con Users
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_culturas', 'id_cultura', 'user_id')
            ->withPivot('nivel_interes') // Incluye la columna adicional
            ->withTimestamps();
    }

    // Relación muchos a muchos con Idioma
    public function idiomas()
    {
        return $this->belongsToMany(Idioma::class, 'idiomas_culturas', 'id_cultura', 'id_idioma')
            ->withPivot('descripcion') // Incluye la columna adicional
            ->withTimestamps();
    }

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_cultura', 'id_cultura', 'id_evento');
    }
}
