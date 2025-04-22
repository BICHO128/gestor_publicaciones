@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Mis Publicaciones</h1>

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Botón para crear nueva publicación --}}
        <a href="{{ route('publicaciones.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-6 inline-block">
            + Nueva Publicación
        </a>

        @if ($posts->isEmpty())
            <p>No tienes publicaciones aún.</p>
        @else
            <table class="min-w-full bg-white shadow rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Título</th>
                        <th class="px-4 py-2 border">Fecha</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-4 py-2 border">{{ $post->titulo }}</td>
                            <td class="px-4 py-2 border">
                                {{ $post->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-2 border space-x-2">
                                <a href="{{ route('publicaciones.show', $post->id) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                                <a href="{{ route('publicaciones.edit', $post->id) }}"
                                    class="text-green-600 hover:underline">Editar</a>
                                <form action="{{ route('publicaciones.destroy', $post->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('¿Eliminar publicación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
