@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-attachment: fixed;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4">
                <div class="bg-white text-gray-800 rounded-2xl p-6 shadow-lg space-y-6">
                    <h2 class="font-bold text-xl">Hola ! {{ Auth::user()->name }}</h2>
                    <div class="space-y-5">
                        <div>
                            <p class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>
                                Ganancias
                            </p>
                            <div class="bg-gray-200 rounded-lg px-4 py-2 text-center">
                                <span class="font-bold text-lg">PEN 2,250</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118L2.05 10.1c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.95-.69L11.049 2.927z"></path></svg>
                                Calificación
                            </p>
                            <div class="bg-gray-200 rounded-lg px-4 py-2 text-center">
                                <span class="font-bold text-lg">4.1</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Total de vehículos
                            </p>
                            <div class="bg-gray-200 rounded-lg px-4 py-2 text-center">
                                <span class="font-bold text-lg">{{ $totalVehiculos }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Disponibles
                            </p>
                            <div class="bg-gray-200 rounded-lg px-4 py-2 text-center">
                                <span class="font-bold text-lg">{{ $vehiculosDisponibles }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                En renta
                            </p>
                            <div class="bg-gray-200 rounded-lg px-4 py-2 text-center">
                                <span class="font-bold text-lg">{{ $vehiculosEnRenta }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="w-full lg:w-3/4">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('propietario.dashboard') }}" class="text-white text-xl font-bold border-b-2 border-yellow-400 pb-2">Mis vehículos</a>
                    </div>
                    <a href="{{ route('vehiculos.create') }}" class="bg-yellow-400 text-black font-bold py-3 px-6 rounded-lg hover:bg-yellow-500 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Registrar vehículo
                    </a>
                </div>

                @if (session('success'))
                    <div class="bg-green-500 text-white font-bold rounded-lg p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="space-y-16">
                    @forelse ($vehiculos as $vehiculo)
                    <div class="bg-gray-100 text-gray-800 rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
                        <!-- Image -->
                        <div class="w-full md:w-4/12 bg-gray-200 flex flex-col items-center justify-center p-6">
                            <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="{{ $vehiculo->modelo }}" class="object-contain max-h-36">
                            <p class="mt-8 font-bold text-yellow-500 tracking-widest text-base">MOONDRIVE</p>
                        </div>

                        <!-- Details -->
                        <div class="w-full md:w-5/12 p-8">
                            <div class="flex-grow">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">{{ $vehiculo->tipo }}</span>
                                    @if($vehiculo->rental_status == 'Disponible')
                                        <span class="bg-green-100 text-green-800 text-sm font-semibold px-4 py-1 rounded-lg">{{ $vehiculo->rental_status }}</span>
                                    @else
                                        <span class="bg-orange-100 text-orange-800 text-sm font-semibold px-4 py-1 rounded-lg">{{ $vehiculo->rental_status }}</span>
                                    @endif
                                </div>
                                <h3 class="text-3xl font-bold mt-1">{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}</h3>
                                <div class="my-6 border-b-2 border-dotted border-gray-300"></div>
                                <div class="flex items-center text-gray-600 mt-8 space-x-6 text-sm">
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-gray-300 p-2 rounded-md"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.084-1.284-.24-1.88M7 12c-1.105 0-2 .9-2 2v2c0 1.1.895 2 2 2h1.244c1.062 0 2.059-.484 2.756-1.308M7 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm10 8v-2a3 3 0 00-3-3H7M3 12h4"></path></svg></div>
                                        <span class="font-medium">{{ $vehiculo->pasajeres }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-gray-300 p-2 rounded-md"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg></div>
                                        <span class="font-medium">1</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="bg-gray-300 p-2 rounded-md"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100 4m0-4a2 2 0 110 4m0-4v.01M18 8a2 2 0 100 4m0-4a2 2 0 110 4m0-4v.01M6 8a2 2 0 100 4m0-4a2 2 0 110 4m0-4v.01"></path></svg></div>
                                        <span class="font-medium">{{ $vehiculo->transmision }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                               <div class="my-6 border-b-2 border-dotted border-gray-300"></div>
                                <p class="text-3xl font-bold">S/ {{ number_format($vehiculo->precio, 2) }} <span class="font-normal text-xl">/ al día</span></p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="w-full md:w-3/12 p-8 flex flex-col justify-center items-center space-y-4 border-t-2 md:border-t-0 md:border-l border-gray-200">
                             <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="bg-yellow-400 text-black font-bold py-3 px-10 rounded-lg w-full text-center hover:bg-yellow-500 transition-colors text-lg">Editar</a>
                             <a href="{{ route('vehiculos.show', $vehiculo) }}" class="bg-gray-800 text-white font-bold py-3 px-10 rounded-lg w-full text-center hover:bg-gray-700 transition-colors text-lg">Ver detalles</a>
                            <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="w-full" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vehículo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white font-bold py-3 px-10 rounded-lg w-full text-center hover:bg-red-700 transition-colors text-lg">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white text-black rounded-2xl p-6 shadow-lg text-center">
                        <p class="font-bold">No tienes vehículos aprobados todavía.</p>
                        <a href="{{ route('vehiculos.create') }}" class="mt-4 inline-block bg-yellow-400 text-black font-bold py-2 px-6 rounded-lg hover:bg-yellow-500 transition-colors">Registrar un nuevo vehículo</a>
                    </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</div>
@endsection 