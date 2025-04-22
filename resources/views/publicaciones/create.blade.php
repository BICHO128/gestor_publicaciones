@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Crear Nueva Publicación</h1>

        <form action="{{ route('publicaciones.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block font-semibold mb-1">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}"
                    class="w-full border px-3 py-2 rounded" required>
                @error('titulo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contenido" class="block font-semibold mb-1">Contenido</label>
                <textarea name="contenido" id="contenido" rows="6" class="w-full border px-3 py-2 rounded" required>{{ old('contenido') }}</textarea>
                @error('contenido')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Guardar Publicación
            </button>
        </form>
    </div>
@endsection
