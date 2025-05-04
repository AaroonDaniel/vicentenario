<?php

namespace App\Observers;

use App\Models\Evento;
use App\Models\Agenda;

class EventoObserver
{
    /**
     * Handle the Evento "created" event.
     */
    public function created(Evento $evento): void
    {
        Agenda::create([
            'id_evento' => $evento->id_evento,
            'titulo' => $evento->nombre,
            'descripcion' => $evento->descripcion,
            'fecha_inicio' => $evento->fecha,
            'fecha_fin' => $evento->fecha, // Puedes modificar esto si tu evento tiene duración
            'ubicacion' => $evento->direccion,
        ]);
    }

    /**
     * Handle the Evento "updated" event.
     */
    public function updated(Evento $evento): void
    {
        //
        // Busca si ya hay una agenda para este evento
        $agenda = $evento->agenda;

        if ($agenda) {
            $agenda->update([
                'titulo' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'fecha_inicio' => $evento->fecha,
                'fecha_fin' => $evento->fecha,
                'ubicacion' => $evento->direccion,
            ]);
        }
    }

    /**
     * Handle the Evento "deleted" event.
     */
    public function deleted(Evento $evento): void
    {
        //
        if ($evento->agenda) {
            $evento->agenda->delete();
        }
    }

    /**
     * Handle the Evento "restored" event.
     */
    public function restored(Evento $evento): void
    {
        //
    }

    /**
     * Handle the Evento "force deleted" event.
     */
    public function forceDeleted(Evento $evento): void
    {
        //
    }
}
