<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pet::all()->load('race')->makeHidden(['created_at', 'updated_at', 'deleted_at']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $pet = new Pet();
            $pet->name = $request->name;
            $pet->address = $request->address;
            $pet->status = $request->status;
            $pet->race_id = @$request->race_id;
            $pet->save();

        } catch (QueryException $e) {

            return response()->json([
                'success' => false,
                'msg' => 'Error al Guardar la Mascota.'
            ]);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Se ha Guardado la Mascota Existosamente.'
        ]);
    }

    public function show(Request $request, Pet $pet){

        try {

            return response()->json([
                'success' => true,
                'pet' => !empty($pet) ? $pet->makeHidden(['created_at', 'updated_at', 'deleted_at', 'race_id']) : null,
                'race' => !empty($pet) ? $pet->race()->first() : null
            ]);
            
        }  catch (QueryException $e) {

            return response()->json([
                'success' => false,
                'msg' => 'Error al Buscar la Mascota.'
            ]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        try {

            $pet->update($request->input());
            
        }  catch (QueryException $e) {

            return response()->json([
                'success' => false,
                'msg' => 'Error al Actualizar la Mascota.'
            ]);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Se ha Actualizado la Mascota Existosamente.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        try {

            $pet->delete();
            
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Error al Eliminar la Mascota.'
            ]);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Se ha Eliminado la Mascota Existosamente.'
        ]);
    }
}
