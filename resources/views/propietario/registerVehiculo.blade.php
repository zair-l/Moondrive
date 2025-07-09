@extends('auth.body')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-transparent">
    <div class="w-[90vw] max-w-5xl h-[80vh] flex rounded-lg overflow-hidden shadow-2xl">
        <!-- Lado Izquierdo: Imagen de carga -->
        <div class="w-1/2 bg-[url('/images/bg-stars.jpg')] bg-cover bg-center flex flex-col items-center justify-center">
            <div class="flex flex-col items-center">
                <div class="rounded-full border-4 border-white p-8 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-8m0 0l-3 3m3-3l3 3m-9 4a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </div>
                <span class="text-white text-xl">Carga la imagen del vehículo</span>
            </div>
        </div>
        <!-- Lado Derecho: Formulario -->
        <div class="w-1/2 bg-[#efdbac] flex flex-col justify-center px-10 py-8">
            <h2 class="text-2xl font-bold mb-4">Registrar Vehículo</h2>
            <form method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <div>
                    <label class="block font-semibold mb-1">Marca</label>
                    <input type="text" name="marca" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Modelo</label>
                    <input type="text" name="modelo" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                <div>
                    <label class="block font-semibold mb-1">Año de fabricación</label>
                    <input type="number" name="anio" min="1900" max="{{ date('Y') }}" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tipo de vehículo</label>
                    <input type="text" name="tipo" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Ej: Familiar, Deportivo, SUV">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Placa del vehículo</label>
                    <input type="text" name="placa" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Precio por día (S/.)</label>
                    <input type="number" name="precio" step="0.01" min="0" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Transmisión</label>
                    <select name="transmision" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        <option value="">Selecciona</option>
                        <option value="Manual">Manual</option>
                        <option value="Automático">Automático</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Pasajeros</label>
                    <input type="number" name="pasajeres" min="1" max="20" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Foto del vehículo</label>
                    <input type="file" name="imagen" accept="image/*" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 bg-white">
                </div>
                <hr class="my-2 border-black/30">
                <button type="submit" class="w-full bg-[#0d2327] text-white font-semibold rounded-full py-2 mt-2 hover:bg-yellow-500 transition">
                    Siguiente &rarr;
                </button>
            </form>
        </div>
    </div>
</div>
@endsection