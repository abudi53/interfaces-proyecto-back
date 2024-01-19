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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
