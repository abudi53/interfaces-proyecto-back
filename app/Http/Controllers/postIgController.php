<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postIg;

class postIgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postIgs = postIg::all();
        return $postIgs;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    
    {
        $postIg = new postIg();
        $postIg ->nombre = $request->nombre;
        $postIg->link =$request->link;
        $postIg->save();
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postIg = postIg::find($id);
        return $postIg ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postIg = postIg::find($id);
        $postIg ->nombre = $request->nombre;
        $postIg->link =$request->link;
        $postIg->save();

        return $postIg;
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postIg= postIg::destroy($id);
        return $postIg;
    }
}
