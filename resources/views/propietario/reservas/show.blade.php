@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen font-sans">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-4xl mx-auto">
            
            <a href="{{ route('propietario.dashboard') }}" class="text-yellow-400 font-semibold mb-8 inline-block"><- Volver al panel</a>

            <h1 class="text-4xl font-bold mb-6">Detalles de la Reserva</h1>

            <div class="bg-gray-800 rounded-2xl p-8">
                <!-- Detalles del Vehículo -->
                <div class="pb-6 border-b border-gray-700">
                    <h2 class="text-2xl font-bold mb-4">Vehículo</h2>
                    <div class="flex items-center">
                        <img src="{{ asset('images/CarroPropietario/' . $alquiler->vehiculo->imagen) }}" alt="Foto del vehículo" class="w-32 h-20 object-cover rounded-lg mr-6">
                        <div>
                            <p class="font-bold text-xl">{{ $alquiler->vehiculo->marca->nombre }} {{ $alquiler->vehiculo->modelo }}</p>
                            <p class="text-gray-400">{{ $alquiler->vehiculo->placa }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detalles del Cliente -->
                <div class="py-6 border-b border-gray-700">
                    <h2 class="text-2xl font-bold mb-4">Cliente</h2>
                    <p><span class="font-bold">Nombre:</span> {{ $alquiler->user->name }} {{ $alquiler->user->lastname }}</p>
                    <p><span class="font-bold">Email:</span> {{ $alquiler->user->email }}</p>
                    <p><span class="font-bold">Teléfono:</span> {{ $alquiler->user->phone ?? 'No especificado' }}</p>
                </div>

                <!-- Detalles de la Reserva -->
                <div class="py-6">
                    <h2 class="text-2xl font-bold mb-4">Reserva</h2>
                    <p><span class="font-bold">Fecha de inicio:</span> {{ $alquiler->fecha_inicio->format('d/m/Y H:i A') }}</p>
                    <p><span class="font-bold">Fecha de fin:</span> {{ $alquiler->fecha_fin->format('d/m/Y H:i A') }}</p>
                    @php
                        $dias = $alquiler->fecha_inicio->diff($alquiler->fecha_fin);
                        $duracion = $dias->days;
                        if ($dias->h > 0 || $dias->i > 0 || $dias->s > 0) {
                            $duracion++;
                        }
                    @endphp
                    <p><span class="font-bold">Duración:</span> {{ $duracion }} día(s)</p>
                    <p><span class="font-bold">Monto total:</span> S/ {{ number_format($alquiler->monto_total, 2) }}</p>
                    <p><span class="font-bold">Estado:</span> 
                        <span class="text-xs font-semibold px-3 py-1 rounded-full
                            @if($alquiler->estado == 'aprobado') bg-green-500/20 text-green-400
                            @elseif($alquiler->estado == 'pendiente') bg-yellow-500/20 text-yellow-400
                            @elseif($alquiler->estado == 'rechazado') bg-red-500/20 text-red-400
                            @else bg-gray-500/20 text-gray-400 @endif">
                            {{ ucfirst($alquiler->estado) }}
                        </span>
                    </p>
                </div>

                <!-- Acciones -->
                @if($alquiler->estado == 'pendiente')
                <div class="pt-6 border-t border-gray-700 flex justify-end space-x-4">
                    <form action="{{ route('propietario.reservas.rechazar', $alquiler->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-700 transition-colors">Rechazar</button>
                    </form>
                    <form action="{{ route('propietario.reservas.aprobar', $alquiler->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors">Aprobar</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 