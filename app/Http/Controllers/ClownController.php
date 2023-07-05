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

    public function show(Clown $clown)
    {
        return $clown;
    }

    public function store(Request $request)
    {
        $clown = Clown::create($request->all());

        return response()->json($clown, 201);
    }

    public function update(Request $request, Clown $clown)
    {
        $clown->update($request->all());

        return response()->json($clown, 200);
    }

    public function destroy(Clown $clown)
    {
        $clown->delete();

        return response()->json(null, 204);
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
