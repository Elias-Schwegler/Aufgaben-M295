<?php

namespace App\Http\Controllers;

use App\Models\Clown;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClownRequest;
use App\Http\Resources\ClownResource;

class ClownController extends Controller
{
    public function index()
    {
        $clowns = Clown::get();
        return ClownResource::collection($clowns);
    }

    #$clown= Clown::create($request -> validated())
    #return ClownResource::make($clown);;



    public function show($id)
    {
        $clown = Clown::find($id);
    
        if ($clown) {
            return response()->json(ClownResource::make($clown), 200);
        } else {
            return response()->json('Clown mit id= ' . $id . ' wurde nicht gefunden.', 404);
        }
    }
    public function store(StoreClownRequest $request)
    {
        $newClown = $request -> validated();
        $clown = Clown::create($newClown);

        if ($clown) {
            return response()->json([
                'message' => 'Clown erfolgreich erstellt.',
                'clown' => $clown
            ], 201);
        } else {
            return response()->json('Fehler beim Erstellen des Clowns.', 500);
        }
    }

    public function update(StoreClownRequest $request, $id)
    {   
        $newClown = $request -> validated();
        $clown = Clown::find($id);

        if ($clown) {
            $clown->update($newClown);
            $clown = $clown->fresh();  // Reload the model from the database
            return response()->json([
                'message' => 'Clown wurde erfolgreich aktualisiert.',
                'clown' => $clown
            ], 200);
        } else {
            return response()->json('Clown wurde nicht gefunden.', 404);
        }
        
    }

    
    public function destroy($id)
    {
        $clown = Clown::find($id);
    
        if ($clown) {
            $clown->delete();
            return response()->json('Clown mit id= ' . $id . ' wurde gelöscht.', 200);
        } else {
            return response()->json('Clown mit id= ' . $id . ' wurde nicht gefunden.', 404);
        }
    }
    
    /*Plenum
    
    public function delete($request $id){
        $clown = Clown::where('id', $id)-first();
        if ($clownd) {
            clown->delete();
            return Response('Clown mit id= ' . $id . 'wurde gelöscht.')
        }
        ELSE {
            return Response('Clown mit id= ' . $id . 'wurde nicht gelöscht.')
        }



        #Billig:
        $clown ->delete();
        ,oder
        $clown = Clown::where('id', $id)->delete();
        return Response('Clown mit id= ' . $id 'wurde gelöscht.')
    }
    */
}
