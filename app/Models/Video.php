<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'url', 'descripcion', 'evento_id', 'fecha'];

    public $timestamps = true;

    /* relacion N:1, muchos videos pertenecen a un evento*/
    // App\Models\Video.php
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id', 'id_evento');
    }



}
