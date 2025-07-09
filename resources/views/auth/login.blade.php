@extends('auth.body')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-transparent p-4">
        <div class="w-full max-w-5xl flex flex-col md:flex-row rounded-lg overflow-hidden shadow-2xl" style="max-height: 90vh;">
            <!-- Lado Izquierdo: Logo y fondo -->
            <div class="hidden md:flex w-full md:w-1/2 bg-[url('/images/bg-stars.jpg')] bg-cover bg-center items-center justify-center p-12">
                <img src="/images/moondrive_logo.png" alt="Logo Moondrive" class="w-64">
            </div>
            <!-- Lado Derecho: Formulario -->
            <div class="w-full md:w-1/2 bg-[#efdbac] flex flex-col justify-center p-8 md:p-12">
                <h2 class="text-black text-2xl font-bold mb-6">Iniciar sesión</h2>
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-black font-semibold mb-1">Correo electrónico</label>
                        <input type="email" name="email" required
                            class="w-full rounded-md px-3 py-2 border-none bg-white text-black focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <div>
                        <label class="block text-black font-semibold mb-1">Contraseña</label>
                        <input type="password" name="password" required
                            class="w-full rounded-md px-3 py-2 border-none bg-white text-black focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    </div>
                    <button type="submit"
                        class="w-full bg-[#0d2327] text-white font-semibold rounded-md py-3 mt-4 hover:bg-yellow-500 transition cursor-pointer">
                        Iniciar sesión
                    </button>
                </form>
                <div class="mt-6 text-center text-sm text-gray-700">
                    ¿No tienes cuenta? <a href="{{ route('register') }}" class="underline hover:text-black">Regístrate ahora</a><br>
                    <a href="{{ route('admin.login') }}" class="underline hover:text-black mt-2 inline-block">Inicio de sesión para administradores</a>
                </div>
            </div>
        </div>
    </div>
@endsection
