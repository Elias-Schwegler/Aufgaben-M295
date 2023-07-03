<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Models\Bike;
use app\Models\Book;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
| Wenn nichts gemacht wird, also https://Aufgaben_M295/api/hello und dan nicht, dann wird die funktion Welcome.blade.php aufgerufen in ressources.
| Achtung Klammer bei return (was auch immer), Klammer mus weg.

*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('menu')->group(function () {

    #Aufgabe 01
    #--------------------------------
    Route::get('/hi', function () {
        return 'Hallo Welt';
    });

    #Aufgabe 05
    #--------------------------------
    Route::get('/hi/{name}', function (string $name) {
        return "Hallo " . $name;
    });

    #Aufgabe 02
    #--------------------------------
    Route::get('/number', function () {
        $number = rand(1, 10);
        return "The random Number is:  " . $number;
    });

    #Aufgabe 03
    #--------------------------------
    Route::get('/www', function () {
        return redirect('https://bbzw.lu.ch');
    });

    #Aufgabe 04
    #--------------------------------
    Route::get('/favi', function () {
        return response()->download(public_path() . '/favicon.ico');
    });

    #Aufgabe 06
    #--------------------------------
    Route::get('/weather', function () {
        return [
            'city' => 'Luzern',
            'temperature' => 20,
            'wind' => 10,
            'rain' => 0,
        ];
    });

    #Aufgabe 07
    #--------------------------------
    Route::get('/error', function () {
        return response()->json(['error' => 'Nicht authorisiert!'], 401);
    });

    #Aufgabe 08
    #--------------------------------
    Route::get('/multiply/{number1}/{number2}', function (float $number1, $number2) {
        return $number1 * $number2;
    })->whereNumber('number1')->whereNumber('number2');



});

Route::prefix('hello-vello')->group(function () {

        #Aufgabe 01 Hallo Vello
    #--------------------------------
    Route::get('/bikes', function () {
        $pdo = new PDO('mysql:host=localhost;dbname=aufgaben', 'root', '');
        $statement = $pdo->prepare('SELECT * FROM bikes'); 
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);    
        return $result;
    });

            #Aufgabe 02 Hallo Vello
    #--------------------------------
    Route::get('/bikes/{id}', function (int $id) {
        $pdo = new PDO('mysql:host=localhost;dbname=aufgaben', 'root', '');
        $statement = $pdo->prepare('SELECT * FROM bikes WHERE id = :id'); # mit : vor id, also :id wird SQL Ingesting verhindert!
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);    
        return $result;
    });
});



Route::prefix('hello-vello')->group(function () {

    #Aufgabe 01 Hallo Vello using Model
    #--------------------------------
    Route::get('/bikes', function () {
        return Bike::get();
    });

    #Aufgabe 02 Hallo Vello using Model
    #--------------------------------
    Route::get('/bikes/{id}', function (int $id) {
        return Bike::find($id);
    });

});

Route::prefix('bookler')->group(function () {

    #Aufgabe 01 Hallo Vello using Model
    #--------------------------------
    Route::get('/books', function () {
        return Book::get();
    });

    #Aufgabe 01 Hallo Vello using Model
    #--------------------------------
    Route::get('/books/{id}', function (int $id) {
        return Book::find($id);
    });

});

