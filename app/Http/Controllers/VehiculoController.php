<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $vehiculos = Vehiculo::where('propietario_id', Auth::id())
                              ->where('estado', 'aprobado')
                              ->get();

        $totalVehiculos = $vehiculos->count();
        $vehiculosDisponibles = $vehiculos->where('rental_status', 'Disponible')->count();
        $vehiculosEnRenta = $vehiculos->where('rental_status', 'En Renta')->count();

        return view('vehiculos.index', compact(
            'vehiculos',
            'totalVehiculos',
            'vehiculosDisponibles',
            'vehiculosEnRenta'
        ));
    }

    public function create(){
        $marcas = Marca::all();
        return view('vehiculos.create', compact('marcas'));
    }

    public function store(Request $request){
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'tipo' => 'required|string|in:Estandar,Mediano,Premium',
            'placa' => 'required|string|max:10|unique:vehiculos,placa',
            'precio' => 'required|numeric|min:0',
            'transmision' => 'required|string|in:Manual,Automático',
            'pasajeres' => 'required|integer|min:1|max:10',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $marca = Marca::firstOrCreate(['nombre' => $request->input('marca')]);

        $vehiculoData = $request->except(['imagen', 'marca']);
        $vehiculoData['marca_id'] = $marca->id;
        $vehiculoData['propietario_id'] = Auth::id();
        $vehiculoData['estado'] = 'pendiente';

        $vehiculo = new Vehiculo($vehiculoData);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::slug($request->modelo . '-' . time()) . '.' . $imagen->getClientOriginalExtension();
            $ruta = public_path('images/CarroPropietario');
            $imagen->move($ruta, $nombreImagen);
            $vehiculo->imagen = $nombreImagen;
        }
        
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Solicitud enviada exitosamente.');
    }   

    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        $marcas = Marca::all();
        return view('vehiculos.edit', compact('vehiculo', 'marcas'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'precio' => 'required|numeric|min:0',
        ]);

        $vehiculo->update([
            'precio' => $request->precio,
        ]);

        return redirect()->route('propietario.dashboard')->with('success', 'Vehículo actualizado exitosamente.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        // Opcional: Eliminar imagen si se está guardando en storage
        // if ($vehiculo->imagen) {
        //     Storage::delete('public/images/CarroPropietario/' . $vehiculo->imagen);
        // }

        $vehiculo->delete();

        return redirect()->route('propietario.dashboard')->with('success', 'Vehículo eliminado exitosamente.');
    }
}
