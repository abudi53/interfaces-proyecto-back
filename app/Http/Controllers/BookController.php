<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $books = Book::all();
            return response()->json([
                'books' => $books
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Error al obtener los libros',
                'error' => $e->getMessage()
            ], 500);
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $imageName = Str::random(32).'.'.$request->foto->getClientOriginalExtension();
            $pdfName = Str::random(32).'.'.$request->pdf->getClientOriginalExtension();

            // Crear post
            Book::create([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'editorial' => $request->editorial,
                'genero' => $request->genero,
                'fecha' => $request->fecha,
                'foto' => $imageName,
                'pdf' => $pdfName,
            ]);

            // Guardar imagen y pdf
            Storage::disk('public')->put($imageName, file_get_contents($request->foto));
            Storage::disk('public')->put($pdfName, file_get_contents($request->pdf));

            // Retornar JSON
            return response()->json([
                'message' => 'Libro creado correctamente'
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Error al crear el libro',
                'error' => $e->getMessage()
            ], 500);
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json([
                'message' => 'Libro no encontrado'
            ], 404);
        }else{

           return response()->json([
                'book' => $book
            ], 200);
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $book = Book::find($id);
            if (!$book) {
                return response()->json([
                    'message' => 'Libro no encontrado'
                ], 404);
            } else {
                $book->titulo = $request->titulo;
                $book->autor = $request->autor;
                $book->editorial = $request->editorial;
                $book->genero = $request->genero;
                $book->fecha = $request->fecha;

                if($request->foto){
                    $storage = Storage::disk('public');

                    // Eliminar imagen anterior
                    if ($storage->exists($book->foto)) {
                        $storage->delete($book->foto);
                    }

                    // Nombre de la nueva imagen
                    $imageName = Str::random(32).'.'.$request->foto->getClientOriginalExtension();
                    $book->foto = $imageName;

                    // Guardar imagen
                    $storage->put($imageName, file_get_contents($request->foto));
                }

                if($request->pdf){
                    $storage = Storage::disk('public');

                    // Eliminar pdf anterior
                    if ($storage->exists($book->pdf)) {
                        $storage->delete($book->pdf);
                    }

                    // Nombre del nuevo pdf
                    $pdfName = Str::random(32).'.'.$request->pdf->getClientOriginalExtension();
                    $book->pdf = $pdfName;

                    // Guardar pdf
                    $storage->put($pdfName, file_get_contents($request->pdf));
                }

                // Actualizar libro
                $book->save();

                // Retornar JSON
                return response()->json([
                    'message' => 'Libro actualizado correctamente'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el libro',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        if(!$book){
            return response()->json([
                'message' => 'Libro no encontrado'
            ], 404);
    }
    $storage = Storage::disk('public');

    if($storage->exists($book->foto)){
        $storage->delete($book->foto);
    }

    if($storage->exists($book->pdf)){
        $storage->delete($book->pdf);
    }

    $book->delete();

    return response()->json([
        'message' => 'Libro eliminado correctamente'
    ], 200);
        //
    }
}
