@extends('layouts.app')

@section('content')

<div class="bg-black text-white min-h-screen" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-attachment: fixed;">

    @if(isset($searchParams['recoger_en']) && $searchParams['recoger_en'])
    <div class="relative w-full text-white text-center mb-8">
        <img src="{{ asset('images/banner_car.png') }}" alt="Banner" class="w-full h-auto object-cover" style="max-height: 300px;">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-bold">Resultados de tu Búsqueda</h1>
        </div>
    </div>
    @endif

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-24">
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="w-full lg:w-1/4">
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl p-6 text-white">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Filtros</h2>
                        <a href="{{ route('alquiler.index') }}" class="text-sm text-gray-300 hover:text-white">Limpiar</a>
                    </div>
                    <form action="{{ route('alquiler.index') }}" method="GET" id="filter-form">
                        <!-- Passthrough search params -->
                        @foreach (request()->only(['recoger_en', 'fecha_rec', 'hora_rec', 'fecha_dev', 'hora_dev']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        
                        <!-- Filters -->
                        <div class="space-y-6">
                            <div>
                                 <p class="font-bold mb-2">Precio Total</p>
                                 <div class="flex justify-between text-sm mt-2">
                                     <input type="number" name="min_price" value="{{ $old_inputs['min_price'] ?? '' }}" placeholder="Mínimo" class="w-1/2 bg-gray-900 border-gray-700 rounded-lg text-center p-2">
                                     <input type="number" name="max_price" value="{{ $old_inputs['max_price'] ?? '' }}" placeholder="Máximo" class="w-1/2 bg-gray-900 border-gray-700 rounded-lg text-center p-2 ml-2">
                                 </div>
                             </div>
                             <div>
                                <p class="font-bold mb-2">Año</p>
                                <div class="flex justify-between text-sm mt-2">
                                    <input type="number" name="min_anio" value="{{ $old_inputs['min_anio'] ?? '' }}" placeholder="Mínimo" class="w-1/2 bg-gray-900 border-gray-700 rounded-lg text-center p-2">
                                    <input type="number" name="max_anio" value="{{ $old_inputs['max_anio'] ?? '' }}" placeholder="Máximo" class="w-1/2 bg-gray-900 border-gray-700 rounded-lg text-center p-2 ml-2">
                                </div>
                            </div>
                             <div>
                                 <p class="font-bold mb-2">Características</p>
                                 <div class="space-y-2">
                                     <label class="flex items-center"><input type="checkbox" name="puertas" value="4" class="form-checkbox bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['puertas']) && $old_inputs['puertas'] == 4) checked @endif> <span class="ml-2">4 puertas</span></label>
                                 </div>
                             </div>
                             <div>
                                 <p class="font-bold mb-2">Transmisión</p>
                                 <div class="space-y-2">
                                     <label class="flex items-center"><input type="radio" name="transmision" value="MANUAL" class="form-radio bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['transmision']) && $old_inputs['transmision'] == 'MANUAL') checked @endif> <span class="ml-2">Manual</span></label>
                                     <label class="flex items-center"><input type="radio" name="transmision" value="AUTOMATICO" class="form-radio bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['transmision']) && $old_inputs['transmision'] == 'AUTOMATICO') checked @endif> <span class="ml-2">Automático</span></label>
                                 </div>
                             </div>
                             <div>
                                 <p class="font-bold mb-2">Categorías</p>
                                 <div class="space-y-2">
                                     <label class="flex items-center"><input type="checkbox" name="categorias[]" value="ESTANDAR" class="form-checkbox bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['categorias']) && in_array('ESTANDAR', $old_inputs['categorias'])) checked @endif> <span class="ml-2">Estándar</span></label>
                                     <label class="flex items-center"><input type="checkbox" name="categorias[]" value="MEDIANO" class="form-checkbox bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['categorias']) && in_array('MEDIANO', $old_inputs['categorias'])) checked @endif> <span class="ml-2">Mediano</span></label>
                                     <label class="flex items-center"><input type="checkbox" name="categorias[]" value="PREMIUM" class="form-checkbox bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['categorias']) && in_array('PREMIUM', $old_inputs['categorias'])) checked @endif> <span class="ml-2">Premium</span></label>
                                 </div>
                             </div>
                              <div>
                                 <p class="font-bold mb-2">Pasajeros</p>
                                 <div class="space-y-2">
                                     <label class="flex items-center"><input type="radio" name="pasajeros" value="4" class="form-radio bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['pasajeros']) && $old_inputs['pasajeros'] == 4) checked @endif> <span class="ml-2">4</span></label>
                                     <label class="flex items-center"><input type="radio" name="pasajeros" value="5" class="form-radio bg-gray-900 border-gray-700 text-yellow-400 h-5 w-5" @if(isset($old_inputs['pasajeros']) && $old_inputs['pasajeros'] == 5) checked @endif> <span class="ml-2">5</span></label>
                                 </div>
                             </div>
                        </div>
                    </form>
                </div>
            </aside>

            <main class="w-full lg:w-3/4">
                <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl p-6 mb-6">
                    <h3 class="text-white text-xl">{{ count($vehiculos) }} coche(s) encontrado(s)</h3>
                </div>

                <div class="space-y-6">
                    @forelse ($vehiculos as $vehiculo)
                        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl overflow-hidden shadow-lg text-white">
                           <div class="flex flex-col md:flex-row">
                                <div class="md:w-1/3">
                                    <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}" class="w-full h-full object-cover">
                                </div>
                                <div class="p-6 md:w-1/3 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold uppercase">{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}</h3>
                                        <p class="text-gray-300">{{ $vehiculo->tipo }}</p>
                                        <div class="flex items-center mt-2">
                                            <span class="text-sm uppercase">{{ $vehiculo->transmision }}</span>
                                            <span class="mx-2">|</span>
                                            <span class="text-sm uppercase">EXCELENTE</span>
                                        </div>
                                    </div>
                                    <p class="text-sm mt-4">MÉTODOS DE PAGO: PAGO ONLINE</p>
                                </div>
                                <div class="bg-gray-800 bg-opacity-50 p-6 md:w-1/3 flex flex-col justify-center items-center text-center">
                                     <div class="flex items-center space-x-4">
                                        <span class="text-2xl font-bold">{{ number_format($vehiculo->precio, 2) }} SOLES</span>
                                        @php
                                            $queryParams = array_merge(request()->query(), ['vehiculo' => $vehiculo->id]);
                                        @endphp
                                        <a href="{{ route('alquiler.show', $queryParams) }}" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-black font-semibold">
                                            RESERVAR
                                        </a>
                                    </div>
                                </div>
                           </div>
                        </div>
                    @empty
                        <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-2xl p-12 text-center">
                            <p class="text-xl">No se encontraron vehículos con los filtros seleccionados.</p>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filter-form');
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
            input.addEventListener('change', function() {
                form.submit();
            });
        });
    });
</script>
@endsection 