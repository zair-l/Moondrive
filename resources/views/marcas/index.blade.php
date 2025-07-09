@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold my-4">Marcas</h1>
    <a href="{{ route('marcas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Agregar Marca
    </a>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4" role="alert">
            <span class="block sm:inline">{{ $message }}</span>
        </div>
    @endif

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marcas as $marca)
                <tr>
                    <td class="border px-4 py-2">{{ $marca->nombre }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('marcas.edit', $marca->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Editar</a>
                        <form action="{{ route('marcas.destroy', $marca->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 