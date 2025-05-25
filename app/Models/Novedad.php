<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    use HasFactory;
    protected $table = 'novedades'; // esto puede ser omitido si el nombre es estándar
    protected $fillable = ['titulo', 'departamento', 'descripcion', 'imagen'];
    public $timestamps = true;

}
