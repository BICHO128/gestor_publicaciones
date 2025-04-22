@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-2">{{ $post->titulo }}</h1>
        <p class="text-gray-600 mb-4">
            Creado el {{ $post->created_at->format('d/m/Y \a \l\a\s H:i') }}
        </p>

        <div class="prose mb-6">
            {!! nl2br(e($post->contenido)) !!}
        </div>

        <a href="{{ route('publicaciones.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded inline-block">
            ← Volver al listado
        </a>
    </div>
@endsection
