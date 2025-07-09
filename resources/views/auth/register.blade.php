@extends('auth.body')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-transparent p-4">
        <div class="w-full max-w-5xl flex flex-col md:flex-row rounded-lg overflow-hidden shadow-2xl" style="max-height: 90vh;">
            <!-- Lado Izquierdo: Logo y fondo -->
            <div class="hidden md:flex w-full md:w-1/2 bg-cover bg-center items-center justify-center p-12" style="background-image: url('/images/bg-stars.jpg');">
                <img src="/images/moondrive_logo.png" alt="Logo Moondrive" class="w-64">
            </div>
            <!-- Lado Derecho: Formulario -->
            <div class="w-full md:w-1/2 bg-[#efdbac] text-black flex flex-col justify-center p-8 md:p-10 overflow-y-auto">
                <h2 class="text-2xl font-bold mb-4">Crea tu cuenta</h2>
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div>
                        <span class="text-black font-semibold">Datos personales</span>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                            <input type="text" name="name" placeholder="Nombre" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <input type="text" name="lastname" placeholder="Apellidos" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <input type="text" name="residence" placeholder="Distrito" value="Lima" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <input type="text" name="phone" placeholder="Celular" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <div class="sm:col-span-2">
                                <input type="date" name="birthdate" placeholder="Fecha de nacimiento" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                @error('birthdate')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="font-semibold">Datos de Acceso a Moondrive</span>
                        <div class="grid grid-cols-1 gap-4 mt-2">
                            <input type="email" name="email" placeholder="Correo electrónico" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <input type="password" name="password" placeholder="Contraseña" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                <input type="password" name="password_confirmation" placeholder="Confirmar tu contraseña" required class="w-full rounded-md px-3 py-2 border-none bg-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            </div>
                             @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="font-semibold">Registrarse como:</span>
                        <select name="user_type" required class="w-full rounded-md px-3 py-2 border-none bg-white mt-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                            <option value="">Selecciona una opción</option>
                            <option value="cliente">Cliente</option>
                            <option value="propietario">Propietario</option>
                        </select>
                         @error('user_type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <hr class="my-4 border-black/30">
                    <button type="submit" class="w-full bg-[#0d2327] text-white font-semibold rounded-full py-3 hover:bg-yellow-500 transition cursor-pointer">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
@endsection