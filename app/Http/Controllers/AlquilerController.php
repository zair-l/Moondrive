<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Carbon\Carbon;
use App\Models\Alquiler;
use Illuminate\Support\Facades\Auth;

class AlquilerController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehiculo::with('marca')
            ->where('estado', 'aprobado')
            ->where('rental_status', 'Disponible');

        // Lógica de búsqueda por destino
        if ($request->filled('recoger_en')) {
            // Aquí puedes agregar una lógica más compleja si quieres buscar en la base de datos
            // Por ahora, simplemente pasamos el término de búsqueda a la vista.
        }

        // Filtro por Precio
        if ($request->filled('min_price')) {
            $query->where('precio', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('precio', '<=', $request->max_price);
        }

        // Filtro por Año
        if ($request->filled('min_anio')) {
            $query->where('anio', '>=', $request->min_anio);
        }
        if ($request->filled('max_anio')) {
            $query->where('anio', '<=', $request->max_anio);
        }

        // Filtro por Características
        if ($request->filled('puertas')) {
            $query->where('puertas', $request->puertas);
        }

        // Filtro por Transmisión
        if ($request->filled('transmision')) {
            $query->where('transmision', $request->transmision);
        }

        // Filtro por Categorías (tipo)
        if ($request->filled('categorias')) {
            $query->whereIn('tipo', $request->categorias);
        }
        
        // Filtro por Pasajeros
        if ($request->filled('pasajeros')) {
            $query->where('pasajeres', $request->pasajeros);
        }

        $vehiculos = $query->get();
            
        return view('alquiler.index', [
            'vehiculos' => $vehiculos,
            'old_inputs' => $request->all(),
            'searchParams' => $request->all()
        ]);
    }

    public function show(Request $request, Vehiculo $vehiculo)
    {
        $searchParams = $request->all();
        $diasReserva = 1;

        if ($request->has(['fecha_rec', 'hora_rec', 'fecha_dev', 'hora_dev'])) {
            $fechaRec = Carbon::parse($request->input('fecha_rec') . ' ' . $request->input('hora_rec'));
            $fechaDev = Carbon::parse($request->input('fecha_dev') . ' ' . $request->input('hora_dev'));
            
            $searchParams['fecha_rec'] = $fechaRec->format('Y-m-d H:i:s');
            $searchParams['fecha_dev'] = $fechaDev->format('Y-m-d H:i:s');

            $diferencia = $fechaRec->diff($fechaDev);
            $diasReserva = $diferencia->days > 0 ? $diferencia->days : 1;
        } else {
            $fechaRec = Carbon::now()->addDay()->setHour(10)->setMinute(0);
            $fechaDev = $fechaRec->copy()->addDays(1);
            
            $searchParams['fecha_rec'] = $fechaRec->format('Y-m-d H:i:s');
            $searchParams['fecha_dev'] = $fechaDev->format('Y-m-d H:i:s');
        }

        $montoTotal = $diasReserva * $vehiculo->precio;

        return view('alquiler.show', compact('vehiculo', 'searchParams', 'diasReserva', 'montoTotal'));
    }

    public function reservar(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'monto_total' => 'required|numeric',
        ]);

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);

        Alquiler::create([
            'user_id' => Auth::id(),
            'vehiculo_id' => $vehiculo->id,
            'propietario_id' => $vehiculo->propietario_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'monto_total' => $request->monto_total,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Tu solicitud de reserva ha sido enviada. Recibirás una notificación cuando el propietario responda.');
    }
}
