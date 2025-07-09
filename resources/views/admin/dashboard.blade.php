@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-position: center;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="flex justify-between items-center mb-16">
            <h1 class="text-4xl font-bold">¡Hola, {{ Auth::user()->name }}!</h1>
            <h2 class="text-3xl font-semibold text-gray-300">Panel de administración</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white font-bold rounded-lg p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Panel Lateral -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-[#efdbac] text-black rounded-2xl p-6 shadow-lg">
                    <h3 class="font-bold text-lg mb-6">Gestión de vehículos pendientes de aprobación</h3>
                    <div class="space-y-5">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Pendientes</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">{{ $estadisticas['pendientes'] }}</span>
                                <span class="bg-yellow-400 text-yellow-800 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Aprobados hoy</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">{{ $estadisticas['aprobados_hoy'] }}</span>
                                <span class="bg-green-400 text-green-800 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Rechazados hoy</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">{{ $estadisticas['rechazados_hoy'] }}</span>
                                <span class="bg-red-400 text-red-800 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">Total procesados</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">{{ $estadisticas['total_procesados'] }}</span>
                                <span class="bg-blue-400 text-blue-800 p-2 rounded-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 9.11c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </aside>

            <!-- Contenido Principal -->
            <main class="w-full lg:w-3/4 space-y-8 bg-black bg-opacity-20 backdrop-blur-sm rounded-2xl p-8">
                
                @forelse ($vehiculosPendientes as $vehiculo)
                    <div class="bg-white text-black rounded-2xl p-6 shadow-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-2xl font-bold">{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs font-bold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">{{ $vehiculo->placa }}</span>
                                    <span class="text-xs font-bold text-yellow-800 bg-yellow-300 px-2 py-1 rounded-full">{{ $vehiculo->estado }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-sm">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                <span>{{ $vehiculo->propietario->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0119 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $vehiculo->propietario->phone ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>{{ $vehiculo->propietario->email ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span>{{ $vehiculo->propietario->residence ?? 'N/A' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>Registrado: {{ $vehiculo->created_at->format('Y-m-d') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1-1m-6 0h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>1 imagen subida</span>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-3">
                            <form action="{{ route('admin.vehiculos.aprobar', $vehiculo) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-yellow-400 text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition-colors">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.vehiculos.rechazar', $vehiculo) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-gray-800 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-700 transition-colors">Rechazar</button>
                            </form>
                            <a href="{{ route('admin.vehiculos.show', $vehiculo) }}" class="bg-gray-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-500 transition-colors flex items-center">Ver detalles</a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white text-black rounded-2xl p-6 shadow-lg text-center">
                        <p class="font-bold">No hay vehículos pendientes de aprobación.</p>
                    </div>
                @endforelse

            </main>
        </div>
    </div>
</div>
@endsection 