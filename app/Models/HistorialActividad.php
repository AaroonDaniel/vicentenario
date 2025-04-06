<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialActividad extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_historial';

    protected $fillable = [
        'user_id',
        'fecha_actividad',
        'tipo_actividad',
        'descripcion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}