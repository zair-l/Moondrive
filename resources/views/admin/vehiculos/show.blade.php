@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-yellow-400 font-bold hover:text-yellow-300 transition-colors mb-8">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Volver al panel
        </a>
        
        <div class="bg-white text-black rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Imagen del vehículo -->
                <div class="bg-gray-200 flex items-center justify-center p-12">
                    <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Imagen de {{ $vehiculo->modelo }}" class="max-h-[500px] w-auto object-contain rounded-lg">
                </div>

                <!-- Detalles del vehículo -->
                <div class="p-12 flex flex-col">
                    <div class="flex-grow">
                        <div class="flex justify-between items-start mb-6">
                            <h1 class="text-4xl font-bold">{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}</h1>
                            <span class="text-xs font-bold uppercase tracking-wider text-yellow-800 bg-yellow-300 px-3 py-1 rounded-full">{{ $vehiculo->estado }}</span>
                        </div>

                        <div class="grid grid-cols-2 gap-x-8 gap-y-4 mb-8 text-sm">
                            <span><strong>Placa:</strong> {{ $vehiculo->placa }}</span>
                            <span><strong>Año:</strong> {{ $vehiculo->anio }}</span>
                            <span><strong>Tipo:</strong> {{ $vehiculo->tipo }}</span>
                            <span><strong>Transmisión:</strong> {{ $vehiculo->transmision }}</span>
                            <span><strong>Asientos:</strong> {{ $vehiculo->pasajeres }}</span>
                            <span><strong>Precio/día:</strong> S/ {{ number_format($vehiculo->precio, 2) }}</span>
                        </div>

                        <hr class="my-8 border-gray-300">

                        <h2 class="text-xl font-bold mb-4">Información del propietario</h2>
                        <div class="grid grid-cols-2 gap-x-8 gap-y-4 text-sm">
                            <span><strong>Nombre:</strong> {{ $vehiculo->propietario->name ?? 'N/A' }}</span>
                            <span><strong>Teléfono:</strong> {{ $vehiculo->propietario->phone ?? 'N/A' }}</span>
                            <span class="col-span-2"><strong>Email:</strong> {{ $vehiculo->propietario->email ?? 'N/A' }}</span>
                            <span class="col-span-2"><strong>Residencia:</strong> {{ $vehiculo->propietario->residence ?? 'N/A' }}</span>
                            <span><strong>Registrado:</strong> {{ $vehiculo->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto pt-8 flex justify-end gap-3">
                        @if($vehiculo->estado == 'pendiente')
                            <form action="{{ route('admin.vehiculos.aprobar', $vehiculo) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-400 text-black font-bold py-3 px-8 rounded-lg hover:bg-yellow-500 transition-colors">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.vehiculos.rechazar', $vehiculo) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-800 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-700 transition-colors">Rechazar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 