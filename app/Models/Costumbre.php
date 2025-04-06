<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumbre extends Model
{
    use HasFactory;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_costumbre';

    // Especificar el nombre de la tabla
    protected $table = 'costumbres';

    // Desactivar timestamps si no se usan (opcional)
    public $timestamps = true;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'id_etnia',
        'nombre',
        'descripcion',
        'vestimenta',
    ];

    // Relaciones
    public function etnia()
    {
        return $this->belongsTo(Etnia::class, 'id_etnia');
    }
}