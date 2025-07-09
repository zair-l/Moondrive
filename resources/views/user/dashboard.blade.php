@extends('layouts.app')

@section('content')
<main class="bg-gray-900">
    <!-- Hero & Search Form Section -->
    <div class="relative">
        <!-- Hero section with background -->
        <div class="h-[600px] bg-cover bg-center relative" style="background-image: url('{{ asset('images/banner_car.png') }}')">
            <div class="h-full w-full bg-black bg-opacity-40 flex items-center">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-4xl md:text-5xl font-bold max-w-xl leading-tight text-white">Moondrive, con tu full carro,<br>¡Arranca chévere y dale play al paro!</h1>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-gray-900 to-transparent"></div>
        </div>

        <!-- Compact Form section that overlaps -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 max-w-6xl mx-auto" style="margin-top: -60px;">
                <div class="bg-white p-2 rounded-xl shadow-2xl">
                    <form action="{{ route('alquiler.index') }}" method="GET">
                        <div class="grid grid-cols-1 gap-3 items-end sm:grid-cols-2 lg:grid-cols-7">
                            
                            <div class="sm:col-span-2 lg:col-span-2">
                                <label for="recoger_en" class="block text-xs font-medium text-gray-700 mb-1">Recoger en:</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                                    </span>
                                    <input type="text" name="recoger_en" id="recoger_en" placeholder="Buscar Destino" class="pl-9 block w-full border-gray-300 rounded-md text-sm py-2 focus:ring-black focus:border-black text-gray-900">
                                </div>
                            </div>

                            <div>
                                <label for="fecha_rec" class="block text-xs font-medium text-gray-700 mb-1">Fecha de rec.</label>
                                <input type="date" name="fecha_rec" id="fecha_rec" value="{{ date('Y-m-d') }}" class="block w-full border-gray-300 rounded-md text-sm py-2 focus:ring-black focus:border-black text-gray-900">
                            </div>

                            <div>
                                <label for="hora_rec" class="block text-xs font-medium text-gray-700 mb-1">Hora</label>
                                <input type="time" name="hora_rec" id="hora_rec" value="10:00" class="block w-full border-gray-300 rounded-md text-sm py-2 focus:ring-black focus:border-black text-gray-900">
                            </div>

                            <div>
                                <label for="fecha_dev" class="block text-xs font-medium text-gray-700 mb-1">Devolución</label>
                                <input type="date" name="fecha_dev" id="fecha_dev" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="block w-full border-gray-300 rounded-md text-sm py-2 focus:ring-black focus:border-black text-gray-900">
                            </div>

                            <div>
                                <label for="hora_dev" class="block text-xs font-medium text-gray-700 mb-1">Hora</label>
                                <input type="time" name="hora_dev" id="hora_dev" value="10:00" class="block w-full border-gray-300 rounded-md text-sm py-2 focus:ring-black focus:border-black text-gray-900">
                            </div>
                            
                            <div class="sm:col-span-2 lg:col-span-1">
                                <button type="submit" class="bg-black text-white font-bold py-2 px-6 rounded-md hover:bg-gray-800 transition-colors w-full text-sm">Buscar</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories & CTA Section -->
    <section class="bg-gray-900 pt-20 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-8 mb-20">
                <div class="bg-white rounded-2xl shadow-lg p-4 text-center w-[280px]">
                    <img src="{{ asset('images/estandar.jpg') }}" alt="Estandar" class="w-full h-32 object-contain mb-4">
                    <h3 class="font-bold text-lg text-black">Estandar</h3>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-4 text-center w-[280px]">
                    <img src="{{ asset('images/mediano.jpg') }}" alt="Mediano" class="w-full h-32 object-contain mb-4">
                    <h3 class="font-bold text-lg text-black">Mediano</h3>
                </div>
                <div class="bg-white rounded-2xl shadow-lg p-4 text-center w-[280px]">
                    <img src="{{ asset('images/premium.jpg') }}" alt="Premium" class="w-full h-32 object-contain mb-4">
                    <h3 class="font-bold text-lg text-black">Premium</h3>
                </div>
            </div>

            <div class="text-left text-white max-w-4xl">
                <h2 class="text-4xl font-bold mb-4">Alquiler de autos baratos en Lima</h2>
                <div class="flex justify-start">
                    <p class="border border-white rounded-full px-6 py-2 text-sm md:text-base">Descubre los mejores precios para ti seleccionando tus fechas de viaje en <span class="font-bold text-yellow-400">MOONDRIVE</span>.</p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
