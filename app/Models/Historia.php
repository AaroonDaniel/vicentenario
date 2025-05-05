<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_historia';

    // Especificar el nombre de la tabla
    protected $table = 'historias';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'fuentes',
        'puntuacion',
        'imagen'
    ];

    // Relación uno a muchos con Culturas
    public function culturas()
    {
        return $this->hasMany(Cultura::class, 'id_historia', 'id_historia');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_historias', 'id_historia', 'user_id')
            ->withPivot('puntuacion');
    }

    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_historia', 'id_historia', 'id_evento');
    }
}
