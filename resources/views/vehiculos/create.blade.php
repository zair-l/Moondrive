@extends('layouts.app')

@section('content')
<div class="bg-gray-900 min-h-screen text-white" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}'); background-size: cover; background-position: center;">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-6xl mx-auto flex flex-col md:flex-row rounded-2xl overflow-hidden shadow-2xl bg-[#efdbac]">
            
            <!-- Lado Izquierdo: Carga de Imagen -->
            <div class="w-full md:w-2/5 bg-gray-900 bg-opacity-80 flex flex-col items-center justify-center p-8 md:p-12 text-center" style="background-image: url('{{ asset('images/bg-stars.jpg') }}'); background-size: cover; background-position: center;">
                <div id="image-preview-container" class="border-4 border-dashed border-gray-400 rounded-full w-48 h-48 flex items-center justify-center mb-6 overflow-hidden">
                    <img id="image-preview" src="" alt="Vista previa de la imagen" class="hidden w-full h-full object-cover"/>
                    <svg id="image-placeholder" class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                </div>
                <h2 class="text-2xl font-bold mb-2">Carga la imagen del vehículo</h2>
                <p class="text-gray-300">Sube una foto clara para atraer a más clientes.</p>
                <label for="imagen" class="mt-6 bg-yellow-400 text-black font-bold py-2 px-6 rounded-full hover:bg-yellow-500 transition-colors cursor-pointer">
                    Seleccionar Archivo
                </label>
            </div>

            <!-- Lado Derecho: Formulario -->
            <div class="w-full md:w-3/5 text-black flex flex-col justify-center p-8 md:p-12">
                <h1 class="text-3xl font-bold mb-6">Registrar Vehículo</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                        <p class="font-bold">¡Oops! Revisa estos datos:</p>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('vehiculos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <input type="file" name="imagen" id="imagen" class="hidden" accept="image/*">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-black font-semibold mb-2" for="marca">Marca</label>
                            <select name="marca" id="marca" required class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <option value="">Seleccione una marca</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mercedes">Mercedes</option>
                                <option value="Tesla">Tesla</option>
                                <option value="BMW">BMW</option>
                                <option value="Kia">Kia</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Renault">Renault</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-black font-semibold mb-2" for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" value="{{ old('modelo') }}" required placeholder="Ej: Corolla" class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-black font-semibold mb-2" for="anio">Año de fabricación</label>
                        <input type="number" name="anio" id="anio" value="{{ old('anio') }}" required placeholder="Ej: 2023" class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    
                    <div>
                        <label class="block text-black font-semibold mb-2" for="placa">Placa del vehículo</label>
                        <input type="text" name="placa" id="placa" value="{{ old('placa') }}" required placeholder="Ej: ABC-123" class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>

                    <hr class="my-4 border-gray-400/50">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                           <label class="block text-black font-semibold mb-2" for="tipo">Tipo de vehículo</label>
                            <select name="tipo" id="tipo" required class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <option value="Estandar" @selected(old('tipo') == 'Estandar')>Estándar</option>
                                <option value="Mediano" @selected(old('tipo') == 'Mediano')>Mediano</option>
                                <option value="Premium" @selected(old('tipo') == 'Premium')>Premium</option>
                            </select>
                        </div>
                         <div>
                            <label class="block text-black font-semibold mb-2" for="transmision">Transmisión</label>
                            <select name="transmision" id="transmision" required class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <option value="Manual" @selected(old('transmision') == 'Manual')>Manual</option>
                                <option value="Automático" @selected(old('transmision') == 'Automático')>Automático</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                             <label class="block text-black font-semibold mb-2" for="pasajeres">Número de asientos</label>
                            <input type="number" name="pasajeres" id="pasajeres" value="{{ old('pasajeres') }}" required placeholder="Ej: 5" class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-black font-semibold mb-2" for="precio">Precio por día (S/)</label>
                            <input type="number" name="precio" id="precio" step="0.01" value="{{ old('precio') }}" required placeholder="Ej: 90.00" class="w-full rounded-md px-4 py-3 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-4">
                        <a href="{{ route('vehiculos.index') }}" class="text-gray-600 font-bold hover:text-black transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-[#0d2327] text-white font-bold py-3 px-8 rounded-lg hover:bg-black transition-colors flex items-center">
                            Siguiente
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('imagen').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('image-placeholder');
            
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    });
</script>
@endsection 