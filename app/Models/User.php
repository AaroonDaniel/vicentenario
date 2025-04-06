<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Clave primaria personalizada
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'country',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación muchos a muchos con Evento (participantes)
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'participantes_eventos', 'user_id', 'id_evento')
            ->withPivot('rol', 'confirmado')
            ->withTimestamps();
    }

    // Relación muchos a muchos con Culturas
    public function culturas()
    {
        return $this->belongsToMany(Cultura::class, 'users_culturas', 'user_id', 'id_cultura')
            ->withPivot('nivel_interes') // Incluye la columna adicional
            ->withTimestamps();
    }

    public function preferencias()
    {
        return $this->hasMany(PreferenciaUsuario::class, 'user_id', 'user_id');
    }

    public function historialActividades()
    {
        return $this->hasMany(HistorialActividad::class, 'user_id', 'user_id');
    }

    // Relación muchos a muchos con Historia
    public function historias()
    {
        return $this->belongsToMany(Historia::class, 'users_historia', 'user_id', 'id_historia')
                    ->withPivot('puntuacion')
                    ->withTimestamps();
    }
}
