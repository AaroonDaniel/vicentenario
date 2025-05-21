<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id_evento,
            'nombre'          => $this->nombre,
            'descripcion'     => $this->descripcion,
            'direccion'       => $this->direccion,
            'tipo'            => $this->tipo,
            'fecha'           => $this->fecha->format('Y-m-d'),
            'hora'            => $this->hora,
            'departamento'    => $this->departamento,
            'modalidad'       => $this->modalidad,
            'enlace'          => $this->enlace,
            'enlaceFormulario' => $this->enlaceFormulario,
            'imagen_ruta'     => $this->imagen_ruta
                ? asset('storage/' . $this->imagen_ruta)
                : null,
        ];
    }
}
