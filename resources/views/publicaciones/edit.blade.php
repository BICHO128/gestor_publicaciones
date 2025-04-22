@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Editar Publicación</h1>

        <form action="{{ route('publicaciones.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titulo" class="block font-semibold mb-1">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $post->titulo) }}"
                    class="w-full border px-3 py-2 rounded" required>
                @error('titulo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="contenido" class="block font-semibold mb-1">Contenido</label>
                <textarea name="contenido" id="contenido" rows="6" class="w-full border px-3 py-2 rounded" required>{{ old('contenido', $post->contenido) }}</textarea>
                @error('contenido')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                Actualizar Publicación
            </button>
        </form>
    </div>
@endsection
