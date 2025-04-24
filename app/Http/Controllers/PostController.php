<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sólo las publicaciones del usuario autenticado
        $posts = Publicacion::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Enviamos a la vista resources/views/publicaciones/index.blade.php
        return view('publicaciones.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Muestra el formulario en resources/views/publicaciones/create.blade.php
        return view('publicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        // Crear la publicación vinculada al usuario
        Publicacion::create([
            'user_id' => auth()->id(),
            'titulo' => $data['titulo'],
            'contenido' => $data['contenido'],
        ]);

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Publicacion::findOrFail($id);

        // Protege que sólo el dueño vea su post
        abort_if($post->user_id !== auth()->id(), 403);

        return view('publicaciones.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Publicacion::findOrFail($id);

        // Protege que sólo el dueño vea su post
        abort_if($post->user_id !== auth()->id(), 403);

        return view('publicaciones.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Publicacion::findOrFail($id);
        abort_if($post->user_id !== auth()->id(), 403);

        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);

        $post->update($data);

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Publicacion::findOrFail($id);
        abort_if($post->user_id !== auth()->id(), 403);

        $post->delete();

        return back()->with('success', 'Publicación eliminada');
    }
}
