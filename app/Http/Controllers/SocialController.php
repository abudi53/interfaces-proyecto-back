<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SocialStoreRequest;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::all();
        return response()->json([
            'socials' => $socials
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'foto' => 'required | mimes:jpg,jpeg,png'
        ]);

        try {
            $imageName = Str::random(32).'.'.$request->foto->getClientOriginalExtension();

            Social::create([
                'nombre' => $request->nombre,
                'url' => $request->url,
                'foto' => $imageName
            ]);

            Storage::disk('public')->put($imageName, file_get_contents($request->foto));

            return response()->json([
                'message' => 'Libro creado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el libro',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    public function show(string $id)
    {
        $social = Social::find($id);
        if(!$social){
            return response()->json([
                'message' => 'Red social no encontrada'
            ], 404);
        }else{

           return response()->json([
                'social' => $social
            ], 200);
        }
        //
    }

    public function update(Request $request, string $id)
    {
        try{

            $social = Social::find($id);

            if(!$social){
                return response()->json([
                    'message' => 'Red social no encontrada'
                ], 404);
            }
            $social->nombre = $request->nombre;
            $social->url = $request->url;
            
            if($request->foto){
                $request->validate([
                    'foto' => 'required | mimes:jpg,jpeg,png'
                ]);
                $storage = Storage::disk('public');
                if($storage->exists($social->foto)){
                    $storage->delete($social->foto);
                }

                $imageName = Str::random(32).'.'.$request->foto->getClientOriginalExtension();
                $social->foto = $imageName;

                $storage->put($imageName, file_get_contents($request->foto));
                
            }
            
            $social->save();

            return response()->json([
                'message' => 'Red social actualizada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la red social',
                'error' => $e->getMessage()
            ], 500);
        }

    }


}
