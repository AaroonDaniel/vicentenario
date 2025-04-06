<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenciaUsuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_preferencia';

    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'tipo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}