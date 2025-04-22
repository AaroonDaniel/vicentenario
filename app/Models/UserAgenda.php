<?php

// app/Models/UserAgenda.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserAgenda extends Model
{

    protected $table = 'user_agenda'; 

    protected $fillable = [
        'user_id', 
        'titulo',
        'descripcion',
        'fecha', 
        'hora_inicio', 
        'hora_fin'
    ];
    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}

