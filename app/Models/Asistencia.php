<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'evento_id', 'asistio', 'nombre_usuario', 'nombre_evento'];

    public $timestamps = true;

}
