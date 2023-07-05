<?php

namespace App\Http\Controllers;

use App\Models\Clown;
use Illuminate\Http\Request;

class ClownController extends Controller
{
    public function index()
    {
        return Clown::all();
    }

    public function show($id)
    {
        $clown = Clown::find($id);
    
        if ($clown) {
            return response()->json($clown, 200);
        } else {
            return response()->json('Clown mit id= ' . $id . ' wurde nicht gefunden.', 404);
        }
    }
    public function store(Request $request)
    {
 
        $clown = Clown::create($request->all());

        if ($clown) {
            return response()->json([
                'message' => 'Clown erfolgreich erstellt.',
                'clown' => $clown
            ], 201);
        } else {
            return response()->json('Fehler beim Erstellen des Clowns.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $clown = Clown::find($id);

        if ($clown) {
            $clown->update($request->all());
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
