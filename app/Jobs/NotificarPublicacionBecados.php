<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notificacion;
use App\Models\Convocatoria;
use App\Models\Candidate;

class NotificarPublicacionBecados implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var convocatoria
     */
    protected $convocatoria;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Convocatoria $convocatoria)
    {
        $this->convocatoria = $convocatoria;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $candidatos = Candidate::all();

        foreach ($candidatos as $candidato) {
            $notificacion = new Notificacion();
            $notificacion->user_id = $candidato->user->id;
            $notificacion->name = "Publicacion resultados";
            $notificacion->description = "Se han publicado los seleccionados de la convocatoria: ".$this->convocatoria->name;
            $notificacion->save();
        }
    }
}