@extends('layouts.app')

@section('content')
<div class="bg-black text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-attachment: fixed; padding: 50px 0;">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-center mb-12">Editar Vehículo</h1>

        <div class="max-w-4xl mx-auto bg-gray-800 bg-opacity-70 backdrop-blur-md rounded-2xl shadow-lg p-8">
            <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Marca -->
                    <div>
                        <label for="marca" class="block text-sm font-bold text-gray-300 mb-2">Marca</label>
                        <input type="text" value="{{ $vehiculo->marca->nombre }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>

                    <!-- Modelo -->
                    <div>
                        <label for="modelo" class="block text-sm font-bold text-gray-300 mb-2">Modelo</label>
                        <input type="text" value="{{ $vehiculo->modelo }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>

                    <!-- Año -->
                    <div>
                        <label for="anio" class="block text-sm font-bold text-gray-300 mb-2">Año</label>
                        <input type="number" value="{{ $vehiculo->anio }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label for="tipo" class="block text-sm font-bold text-gray-300 mb-2">Tipo</label>
                        <input type="text" value="{{ $vehiculo->tipo }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>
                    
                    <!-- Placa -->
                    <div>
                        <label for="placa" class="block text-sm font-bold text-gray-300 mb-2">Placa</label>
                        <input type="text" value="{{ $vehiculo->placa }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>
                    
                    <!-- Transmisión -->
                    <div>
                        <label for="transmision" class="block text-sm font-bold text-gray-300 mb-2">Transmisión</label>
                        <input type="text" value="{{ $vehiculo->transmision }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>

                    <!-- Pasajeros -->
                    <div>
                        <label for="pasajeres" class="block text-sm font-bold text-gray-300 mb-2">Pasajeros</label>
                        <input type="number" value="{{ $vehiculo->pasajeres }}" class="w-full bg-gray-700 border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-400 cursor-not-allowed" readonly>
                    </div>

                    <!-- Precio por día -->
                    <div class="md:col-span-2">
                        <label for="precio" class="block text-sm font-bold text-yellow-400 mb-2">Precio por día</label>
                        <input type="number" id="precio" name="precio" value="{{ $vehiculo->precio }}" class="w-full bg-gray-200 text-black border-gray-600 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-yellow-500 text-lg" step="0.01" required>
                    </div>
                </div>

                <!-- Botones -->
                <div class="mt-10 flex justify-end gap-4">
                    <a href="{{ route('vehiculos.index') }}" class="bg-gray-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-500 transition-colors">Cancelar</a>
                    <button type="submit" class="bg-yellow-400 text-black font-bold py-3 px-8 rounded-lg hover:bg-yellow-500 transition-colors">Actualizar Vehículo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 