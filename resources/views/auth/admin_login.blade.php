@extends('auth.body')

@section('content')
<div class="flex min-h-screen">
    <!-- Lado Izquierdo: Logo y fondo -->
    <div class="w-1/2 bg-cover bg-center flex items-center justify-center p-12" style="background-image: url('{{ asset('images/fondoEstrellas.jpg') }}');">
        <img src="{{ asset('images/moondrive_logo.png') }}" alt="Logo Moondrive" class="w-80">
    </div>

    <!-- Lado Derecho: Formulario -->
    <div class="w-1/2 bg-[#efdbac] flex flex-col justify-center items-center px-16">
        <div class="w-full max-w-md text-center">
            <h1 class="text-3xl font-bold text-black mb-2">Panel de Administrador</h1>
            <p class="text-gray-700 mb-8">Acceso exclusivo para administradores</p>

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
                @csrf
                <div class="text-left">
                    <label class="block text-black font-semibold mb-2">Email de Administrador</label>
                    <input type="email" name="email" required class="w-full rounded-md px-4 py-3 border-none bg-white text-black focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div class="text-left">
                    <label class="block text-black font-semibold mb-2">Contraseña</label>
                    <input type="password" name="password" required class="w-full rounded-md px-4 py-3 border-none bg-white text-black focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                
                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                        <label for="remember" class="ml-2 text-gray-700">Recordar sesión</label>
                    </div>
                    <a href="#" class="font-semibold text-gray-700 hover:text-black">¿Haz olvidado tu contraseña? Haz click Aquí</a>
                </div>

                <button type="submit" class="w-full bg-[#0d2327] text-white font-semibold rounded-lg py-3 mt-6 hover:bg-yellow-500 transition-colors">
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 