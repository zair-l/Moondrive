<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Alquiler;
use Carbon\Carbon;

class UpdateRentalStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-rental-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de los alquileres a "completado" y el de los vehículos a "Disponible" una vez que la fecha de fin ha pasado.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando la actualización de estados de alquiler...');

        $alquileresTerminados = Alquiler::where('estado', 'aprobado')
                                       ->where('fecha_fin', '<', Carbon::now())
                                       ->get();

        if ($alquileresTerminados->isEmpty()) {
            $this->info('No hay alquileres para actualizar.');
            return;
        }

        foreach ($alquileresTerminados as $alquiler) {
            $alquiler->estado = 'completado';
            $alquiler->save();

            $vehiculo = $alquiler->vehiculo;
            if ($vehiculo) {
                $vehiculo->rental_status = 'Disponible';
                $vehiculo->save();
                $this->line("Alquiler #{$alquiler->id} completado. Vehículo #{$vehiculo->id} ahora está Disponible.");
            }
        }

        $this->info("Actualización finalizada. Se procesaron {$alquileresTerminados->count()} alquileres.");
    }
}
