@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}')">
    <div class="min-h-screen bg-black bg-opacity-60 py-24">
        <div class="container mx-auto px-4 lg:px-20">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(isset($searchParams['recoger_en']) && $searchParams['recoger_en'])
                <div class="bg-gray-800 bg-opacity-50 text-white p-4 rounded-lg mb-8 text-center text-sm">
                    RECOGER: {{ strtoupper($searchParams['recoger_en']) }} , DEVOLUCION: {{ strtoupper($searchParams['recoger_en']) }} ,
                    PERÚ {{ \Carbon\Carbon::parse($searchParams['fecha_rec'])->format('d M, H:i') }} - {{ \Carbon\Carbon::parse($searchParams['fecha_dev'])->format('d M, H:i') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-black bg-opacity-70 rounded-2xl p-6">
                        <h1 class="text-4xl font-bold mb-6 uppercase text-white">{{ $vehiculo->marca->nombre }} {{ $vehiculo->modelo }}</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Imagen principal del vehículo" class="w-full h-auto rounded-lg">
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Thumbnail 1" class="w-full h-auto rounded-lg">
                                <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Thumbnail 2" class="w-full h-auto rounded-lg">
                                <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Thumbnail 3" class="w-full h-auto rounded-lg">
                                <div class="relative">
                                    <img src="{{ asset('images/CarroPropietario/' . $vehiculo->imagen) }}" alt="Thumbnail 4" class="w-full h-auto rounded-lg">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                        <span class="text-white font-bold">Ver fotos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6 text-center text-white">
                            <div class="bg-white/10 p-4 rounded-lg">
                                <span class="font-bold text-lg">PASAJEROS</span>
                                <div class="flex items-center justify-center mt-2">
                                    <span class="text-2xl font-bold">{{ $vehiculo->pasajeres }}</span>
                                </div>
                            </div>
                            <div class="bg-white/10 p-4 rounded-lg">
                                <span class="font-bold text-lg uppercase">{{ $vehiculo->transmision }}</span>
                            </div>
                            <div class="bg-white/10 p-4 rounded-lg">
                                <span class="font-bold text-lg uppercase">{{ $vehiculo->tipo }}</span>
                            </div>
                            <div class="border border-white text-white p-4 rounded-lg">
                                <span class="font-bold text-lg">PAGO ONLINE</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#D4C2A3] rounded-2xl p-6 flex flex-col justify-between">
                    <form action="{{ route('alquiler.reservar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">
                        <input type="hidden" name="fecha_inicio" value="{{ $searchParams['fecha_rec'] }}">
                        <input type="hidden" name="fecha_fin" value="{{ $searchParams['fecha_dev'] }}">
                        <input type="hidden" id="monto_total_input" name="monto_total" value="{{ $montoTotal }}">

                        <div>
                            <h2 class="text-3xl font-bold mb-6 text-center text-[#1A1A2E]">RESERVA</h2>
                            <div class="bg-[#E4D5B7] p-3 rounded-lg flex justify-between items-center mb-4">
                                <span class="text-[#1A1A2E]">VALOR DEL VEHICULO</span>
                                <span class="font-bold text-[#1A1A2E]">{{ number_format($vehiculo->precio, 2) }} SOLES</span>
                            </div>
                            <div class="bg-[#E4D5B7] p-3 rounded-lg flex justify-between items-center mb-4">
                                <span class="text-[#1A1A2E]">MODELO</span>
                                <span class="font-bold text-[#1A1A2E] uppercase">{{ $vehiculo->modelo }}</span>
                            </div>
                            <div class="bg-[#E4D5B7] p-3 rounded-lg flex justify-between items-center mb-4">
                                <label for="dias-reserva" class="text-[#1A1A2E]">DIAS DE LA RESERVA</label>
                                <input type="number" id="dias-reserva" value="{{ $diasReserva }}" min="1" class="font-bold bg-transparent text-right w-20 text-[#1A1A2E] focus:outline-none" name="dias_reserva">
                            </div>
                            <p class="text-xs text-gray-700 mt-4">
                                MoonDrive cobra una comisión del 10% sobre el valor del alquiler por el uso de la plataforma, soporte y gestión del servicio.
                            </p>
                        </div>
                        <div>
                            <div class="bg-[#1A1A2E] text-white p-4 rounded-lg flex justify-between items-center mt-6">
                                <span class="font-bold">MONTO TOTAL</span>
                                <span class="font-bold" id="monto-total">{{ number_format($montoTotal, 2) }} SOLES</span>
                            </div>
                            <div class="flex space-x-4 mt-4">
                                <a href="{{ route('alquiler.index') }}" class="w-1/2 bg-gray-500 text-white text-center py-3 rounded-lg hover:bg-gray-600 font-semibold">CANCELAR</a>
                                <button type="submit" class="w-1/2 bg-[#1A1A2E] text-white text-center py-3 rounded-lg hover:bg-black font-semibold">CONTINUAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const diasInput = document.getElementById('dias-reserva');
    const montoTotalSpan = document.getElementById('monto-total');
    const montoTotalInput = document.getElementById('monto_total_input');
    const precioPorDia = {{ $vehiculo->precio }};

    function actualizarTotal() {
        let dias = parseInt(diasInput.value);
        if (isNaN(dias) || dias < 1) {
            dias = 1;
            diasInput.value = 1;
        }

        const nuevoTotal = precioPorDia * dias;
        montoTotalSpan.textContent = nuevoTotal.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' SOLES';
        montoTotalInput.value = nuevoTotal.toFixed(2);
    }

    diasInput.addEventListener('input', actualizarTotal);
});
</script>
@endsection 