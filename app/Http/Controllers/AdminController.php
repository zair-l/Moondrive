<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class AdminController extends Controller
{
    public function dashboard()
    {
        $vehiculosPendientes = Vehiculo::where('estado', 'pendiente')->get();
        $estadisticas = [
            'pendientes' => $vehiculosPendientes->count(),
            'aprobados_hoy' => Vehiculo::where('estado', 'aprobado')->whereDate('updated_at', today())->count(),
            'rechazados_hoy' => Vehiculo::where('estado', 'rechazado')->whereDate('updated_at', today())->count(),
            'total_procesados' => Vehiculo::whereIn('estado', ['aprobado', 'rechazado'])->whereDate('updated_at', today())->count(),
        ];

        return view('admin.dashboard', compact('vehiculosPendientes', 'estadisticas'));
    }

    public function show(Vehiculo $vehiculo)
    {
        return view('admin.vehiculos.show', compact('vehiculo'));
    }

    public function aprobarVehiculo(Vehiculo $vehiculo)
    {
        $vehiculo->update(['estado' => 'aprobado']);
        return redirect()->route('admin.dashboard')->with('success', 'Vehículo aprobado correctamente.');
    }

    public function rechazarVehiculo(Vehiculo $vehiculo)
    {
        $vehiculo->update(['estado' => 'rechazado']);
        return redirect()->route('admin.dashboard')->with('success', 'Vehículo rechazado correctamente.');
    }
}
