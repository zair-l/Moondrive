<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Moondrive</title>
</head>
<body class="bg-gray-900 text-white font-sans">
    <header class="absolute top-0 left-0 w-full z-20 bg-gradient-to-b from-black/70 to-transparent">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="@guest {{ url('/') }} @else @if(Auth::user()->rol == 'propietario') {{ route('propietario.dashboard') }} @else {{ url('/') }} @endif @endguest" class="flex items-center font-bold text-lg">
                <img src="/images/moondrive_logo.png" alt="Moondrive" class="h-8 mr-2">
                <span class="text-yellow-400">MOON</span><span class="text-white">DRIVE</span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="flex-grow flex justify-center">
                <nav class="flex items-center space-x-8">
                    <a href="{{ route('alquiler.index') }}" class="hover:text-yellow-400 transition-colors">Alquiler de autos</a>
                    <a href="#" class="hover:text-yellow-400 transition-colors">Sobre nosotros</a>
                    <a href="#" class="hover:text-yellow-400 transition-colors">Contacto</a>
                </nav>
            </div>

            <!-- Auth Links -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <span class="font-semibold">Bienvenido, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="bg-red-600 text-white font-bold py-2 px-5 rounded-lg hover:bg-red-700 transition-colors cursor-pointer text-sm">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-gray-200 text-black font-bold py-2 px-5 rounded-lg hover:bg-gray-300 transition-colors text-sm">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-black font-bold py-2 px-5 rounded-lg hover:bg-yellow-500 transition-colors text-sm">Registrarse</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-black bg-opacity-90">
            <nav class="flex flex-col items-center space-y-4 py-8">
                <a href="#" class="text-white font-semibold hover:text-yellow-400 transition">Alquiler de autos</a>
                <a href="#" class="text-white font-semibold hover:text-yellow-400 transition">Sobre nosotros</a>
                <a href="#" class="text-white font-semibold hover:text-yellow-400 transition">Contacto</a>
                <div class="pt-4 border-t border-gray-700 w-full flex flex-col items-center space-y-4">
                @auth
                    <span class="text-white font-semibold">Bienvenido, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                       class="bg-red-500 text-white font-semibold rounded-full px-5 py-2 transition hover:bg-red-600 cursor-pointer w-40 text-center">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-black font-semibold rounded-full px-5 py-2 transition hover:bg-gray-200 w-40 text-center">Iniciar Sesion</a>
                    <a href="{{ route('register') }}" class="bg-yellow-400 text-black font-semibold rounded-full px-5 py-2 transition hover:bg-yellow-500 w-40 text-center">Registrarse</a>
                @endauth
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>