@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen font-sans">
    
    <header class="relative bg-cover h-72" style="background-image: url('{{ asset('images/fondo_propietario.jpg') }}'); background-position: center 35%;">
        <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-yellow-400">Panel de Propietario</h1>
            <p class="mt-4 max-w-2xl text-sm">Gestiona tus vehículos, controla tus reservas y maximiza tus ingresos.</p>
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('vehiculos.create') }}" class="bg-yellow-400 text-black font-bold py-2 px-5 rounded-lg hover:bg-yellow-500 transition-colors">
                    Registrar Vehículo
                </a>
                <a href="{{ route('vehiculos.index') }}" class="bg-gray-700 text-white font-bold py-2 px-5 rounded-lg hover:bg-gray-600 transition-colors">
                    Ver mis Vehículos
                </a>
            </div>
        </div>
    </header>

    <main class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold mb-8">¡BIENVENIDO DE VUELTA, {{ Auth::user()->name }}!</h1>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-gray-800 rounded-xl p-6 text-center">
                    <p class="text-5xl font-bold text-yellow-400">{{ $vehiculosActivos }}</p>
                    <p class="text-gray-400 mt-2">Vehículos activos</p>
                </div>
                <div class="bg-gray-800 rounded-xl p-6 text-center">
                    <p class="text-5xl font-bold text-yellow-400">S/ {{ number_format($ingresosEsteMes, 2) }}</p>
                    <p class="text-gray-400 mt-2">Ingresos este mes</p>
                </div>
                <div class="bg-gray-800 rounded-xl p-6 text-center">
                    <p class="text-5xl font-bold text-yellow-400">{{ $reservasTotales }}</p>
                    <p class="text-gray-400 mt-2">Reservas totales</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Historial de reservas -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Historial de reservas</h2>
                    <div class="space-y-4">
                        @forelse($historialReservas as $reserva)
                            @php
                                $dias = $reserva->fecha_inicio->diff($reserva->fecha_fin)->days;
                                $dias = $dias == 0 ? 1 : $dias;
                            @endphp
                            <div class="bg-gray-800 p-4 rounded-lg flex justify-between items-center">
                                <div>
                                    <p class="font-bold">{{ $reserva->user->name }}</p>
                                    <p class="text-sm text-gray-400">{{ $reserva->vehiculo->marca->nombre }} {{ $reserva->vehiculo->modelo }} - {{ $dias }} días</p>
                                    <p class="text-sm text-gray-400">{{ $reserva->fecha_inicio->format('d M') }} - {{ $reserva->fecha_fin->format('d M Y') }}</p>
                                </div>
                                <span class="text-xs font-semibold px-3 py-1 rounded-full
                                    @if($reserva->estado == 'aprobado') bg-green-500/20 text-green-400
                                    @elseif($reserva->estado == 'rechazado') bg-red-500/20 text-red-400
                                    @else bg-gray-500/20 text-gray-400 @endif">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-400">No tienes historial de reservas.</p>
                        @endforelse

                        <div class="bg-gray-800 p-4 rounded-lg"><p class="font-bold">Valentino Palacios</p><p class="text-sm text-gray-400">Toyota Corolla 2022 - 3 días</p><p class="text-sm text-gray-400">16-18 Jun 2025</p></div>
                        <div class="bg-gray-800 p-4 rounded-lg"><p class="font-bold">Juan Solozandro</p><p class="text-sm text-gray-400">Toyota Corolla 2022 - 6 días</p><p class="text-sm text-gray-400">21-26 May 2025</p></div>
                    </div>
                    @if($historialReservas->count() > 4)
                        <button class="text-yellow-400 mt-6 font-semibold flex items-center justify-center w-full">+ Ver más</button>
                    @endif
                </div>

                <!-- Próximas reservas -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Próximas reservas</h2>
                    <div class="space-y-4">
                        @forelse($proximasReservas as $reserva)
                             @php
                                $dias = $reserva->fecha_inicio->diff($reserva->fecha_fin)->days;
                                $dias = $dias == 0 ? 1 : $dias;
                            @endphp
                            <div class="bg-gray-800 p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold">{{ $reserva->user->name }}</p>
                                        <p class="text-sm text-gray-400">{{ $reserva->vehiculo->marca->nombre }} {{ $reserva->vehiculo->modelo }} - {{ $dias }} días</p>
                                        <p class="text-sm text-gray-400">{{ $reserva->fecha_inicio->format('d M') }} - {{ $reserva->fecha_fin->format('d M Y') }}</p>
                                    </div>
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400">Pendiente</span>
                                </div>
                                <div class="text-right mt-2">
                                    <a href="{{ route('propietario.reservas.show', $reserva->id) }}" class="bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg hover:bg-yellow-500 transition-colors text-sm">Ver detalles</a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400">No tienes reservas pendientes.</p>
                        @endforelse


                        <div class="bg-gray-800 p-4 rounded-lg"><div class="flex justify-between items-start"><div><p class="font-bold">You Gonzales</p><p class="text-sm text-gray-400">Toyota Corolla 2022 - 3 días</p><p class="text-sm text-gray-400">27-29 Jun 2025</p></div><span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-500/20 text-green-400">Confirmado</span></div></div>
                        <div class="bg-gray-800 p-4 rounded-lg"><div class="flex justify-between items-start"><div><p class="font-bold">Johnny Sins</p><p class="text-sm text-gray-400">Mercedes-Benz T4 - 4 días</p><p class="text-sm text-gray-400">05-08 Agos 2025</p></div></div><div class="text-right mt-2"><a href="#" class="bg-yellow-400 text-gray-900 font-bold py-2 px-4 rounded-lg hover:bg-yellow-500 transition-colors text-sm">Ver detalles</a></div></div>

                    </div>
                    @if($proximasReservas->count() > 4)
                        <button class="text-yellow-400 mt-6 font-semibold flex items-center justify-center w-full">+ Ver más</button>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
