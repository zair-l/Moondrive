@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-attachment: fixed;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-4xl font-bold text-center mb-12">Detalles del Vehículo</h1>

        <div class="bg-gray-800 bg-opacity-50 backdrop-blur-md rounded-2xl shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Vehicle Image -->
                <div class="w-full md:w-1/2 p-8 flex flex-col items-center justify-center bg-gray-900 bg-opacity-50">
                    <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Imagen de {{ $vehiculo->modelo }}" class="max-w-full h-auto rounded-lg shadow-2xl object-contain">
                    <p class="mt-6 font-bold text-yellow-400 tracking-widest text-xl">MOONDRIVE</p>
                </div>

                <!-- Vehicle Details -->
                <div class="w-full md:w-1/2 p-10 space-y-6">
                    <div>
                        <h2 class="text-4xl font-extrabold text-yellow-400">{{ $vehiculo->marca->nombre }}</h2>
                        <h3 class="text-5xl font-bold">{{ $vehiculo->modelo }}</h3>
                    </div>

                    <div class="border-b border-gray-600 my-6"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-lg">
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-400">Año:</p>
                            <p class="font-bold text-2xl">{{ $vehiculo->anio }}</p>
                        </div>
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-400">Placa:</p>
                            <p class="font-bold text-2xl">{{ $vehiculo->placa }}</p>
                        </div>
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-400">Transmisión:</p>
                            <p class="font-bold text-2xl">{{ $vehiculo->transmision }}</p>
                        </div>
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                            <p class="font-semibold text-gray-400">Pasajeros:</p>
                            <p class="font-bold text-2xl">{{ $vehiculo->pasajeres }}</p>
                        </div>
                    </div>
                    
                    <div class="border-b border-gray-600 my-6"></div>

                    <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4">
                        <p class="font-semibold text-gray-400">Precio por día:</p>
                        <p class="text-4xl font-bold text-yellow-400">S/ {{ number_format($vehiculo->precio, 2) }}</p>
                    </div>

                    <div class="pt-8 text-center">
                        <a href="{{ url()->previous() }}" class="bg-yellow-400 text-black font-bold py-3 px-10 rounded-lg hover:bg-yellow-500 transition-colors text-lg inline-block">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 