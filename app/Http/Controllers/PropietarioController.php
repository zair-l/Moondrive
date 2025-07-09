<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Alquiler;
use Illuminate\Support\Facades\Auth;

class PropietarioController extends Controller
{
    public function dashboard()
    {
        $propietarioId = Auth::id();

        $vehiculosActivos = Vehiculo::where('propietario_id', $propietarioId)
                                    ->where('estado', 'aprobado')
                                    ->count();

        $ingresosEsteMes = Alquiler::where('propietario_id', $propietarioId)
                                    ->where('estado', 'aprobado')
                                    ->whereMonth('created_at', now()->month)
                                    ->sum('monto_total');

        $reservasTotales = Alquiler::where('propietario_id', $propietarioId)->count();

        $proximasReservas = Alquiler::with(['user', 'vehiculo'])
                                ->where('propietario_id', $propietarioId)
                                ->where('estado', 'pendiente')
                                ->orderBy('fecha_inicio', 'asc')
                                ->take(5)
                                ->get();
        
        $historialReservas = Alquiler::with(['user', 'vehiculo'])
                                ->where('propietario_id', $propietarioId)
                                ->whereIn('estado', ['aprobado', 'rechazado', 'completado'])
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();


        return view('propietario.dashboard', compact(
            'vehiculosActivos',
            'ingresosEsteMes',
            'reservasTotales',
            'proximasReservas',
            'historialReservas'
        ));
    }

    public function showReserva(Alquiler $alquiler)
    {
        if (Auth::id() !== $alquiler->propietario_id) {
            abort(403);
        }
        return view('propietario.reservas.show', compact('alquiler'));
    }

    public function aprobarReserva(Request $request, Alquiler $alquiler)
    {
        if (Auth::id() !== $alquiler->propietario_id) {
            abort(403);
        }

        $alquiler->update(['estado' => 'aprobado']);
        $alquiler->vehiculo->update(['rental_status' => 'En Renta']);

        // Aquí se podría añadir una notificación para el usuario.

        return redirect()->route('propietario.dashboard')->with('success', 'Reserva aprobada con éxito.');
    }

    public function rechazarReserva(Request $request, Alquiler $alquiler)
    {
        if (Auth::id() !== $alquiler->propietario_id) {
            abort(403);
        }

        $alquiler->update(['estado' => 'rechazado']);

        // Aquí se podría añadir una notificación para el usuario.

        return redirect()->route('propietario.dashboard')->with('success', 'Reserva rechazada.');
    }
}
