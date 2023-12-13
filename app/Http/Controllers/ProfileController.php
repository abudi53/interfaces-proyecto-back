<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile = new Profile();
        $profile->user_id = $request->user_id;
        $profile->nombre = $request->nombre;
        $profile->apellido = $request->apellido;
        $profile->cedula = $request->cedula;
        $profile->telefono = $request->telefono;
        $profile->direccion = $request->direccion;
        $profile->pais = $request->pais;
        $profile->estado = $request->estado;
        $profile->ciudad = $request->ciudad;

        $profile->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = Profile::find($id);
        return $profile;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profile = Profile::find($id);
        $profile->nombre = $request->nombre;
        $profile->apellido = $request->apellido;
        $profile->cedula = $request->cedula;
        $profile->telefono = $request->telefono;
        $profile->direccion = $request->direccion;
        $profile->pais = $request->pais;
        $profile->estado = $request->estado;
        $profile->ciudad = $request->ciudad;

        $profile->save();

        return $profile;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
