<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bike;
use App\Models\Book;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\Author;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ClownController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
# Wenn nichts gemacht wird, also https://Aufgaben_M295.test/api/hello und dan nicht, dann wird die funktion Welcome.blade.php aufgerufen in ressources.
# /api/ nach der base URL .test/... !!!
| Achtung Klammer bei return (was auch immer), Klammer mus weg.
# php artisan make: migration create_videos_table
# php artisan migrate
#php artisan migrate:refresh
#or
#php artisan migrate:fresh
#create Model: php artisan make:model <<Book>> -m if migration should be created with it as well
# in env die DB auswählen ...

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
/* 
Route::prefix('bookler')->group(function () {

    #Aufgabe 01 Bookler using Model
    #--------------------------------
    Route::get('/books', function () {
        return Book::get();
    });

    #Aufgabe 01 Bookler using Model
    #--------------------------------
    Route::get('/books/{id}', function (int $id) {
        return Book::find($id);
    });

     #Aufgabe 03 Bookler using Model
    #--------------------------------
    Route::get('/book-finder/slug/{slug}', function (string $slug) {
        return Book::where('slug','like', $slug.'%')->get();
    });
    
    #Aufgabe 04 Bookler using Model
    #--------------------------------
    Route::get('/book-finder/year/{year}', function (int $year) {
        return Book::where('year', $year)->get();
    });
    #Aufgabe 05 Bookler using Model
    #--------------------------------
    Route::get('/book-finder/max-pages/{pages}', function (int $pages) {
        return Book::where('pages', '<', $pages)->get();
    });
    #Aufgabe 06 Bookler using Model
    #--------------------------------
    Route::get('/search/{search}', function (string $search) {
        return Book::where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')->get(); #mit orWhere kannes eines oder das andere sein, sonnst bei zwei where müssten beide zutreffen.
    }) ->where('search', '[A-z0-9-]+'); #Regular expressions
    #Aufgabe 07 Bookler using Model
    #--------------------------------
    Route::get('/meta/count', function () {
        return ['count' => Book::count()]; #asoziatives array, erstes element heisst count mit dessen book count.
    });
    
    Route::get('/meta/avg-pages', function () {
        return ['avg-pages' => Book::avg('pages')];
    });
    #Aufgabe 08 Bookler using Model
    #--------------------------------
    Route::get('/dashboard', function () {
        return [
            'books' => Book::count(),
            'pages' => Book::sum('pages'),
            'oldest' => Book::orderBy('year', 'asc')->first()->title,
            'newest' => Book::orderBy('year', 'desc')->first()->title,
        ];
    });
});
*/

    #Aufgabe XX Bookler Routes using Controller
    #--------------------------------

Route::prefix('bookler')->group(function () {
    Route::get('/books', [BookController::class, 'getBooks']);
    Route::get('/books/{id}', [BookController::class, 'getBookById']);
    Route::get('/book-finder/slug/{slug}', [BookController::class, 'getBooksBySlug']);
    Route::get('/book-finder/year/{year}', [BookController::class, 'getBooksByYear']);
    Route::get('/book-finder/max-pages/{pages}', [BookController::class, 'getBooksByMaxPages']);
    Route::get('/search/{search}', [BookController::class, 'searchBooks'])->where('search', '[A-z0-9-]+');
    Route::get('/meta/count', [BookController::class, 'countBooks']);
    Route::get('/meta/avg-pages', [BookController::class, 'avgPages']);
    Route::get('/dashboard', [BookController::class, 'dashboard']);
});


#Route::get('/topics/{slug}/posts', [TopicController::class, 'postsByTopic']);
#Route::get('/tags/{tagSlug}/posts', [TagController::class, 'postsByTag']);

Route::get('/relationsheep/posts', [PostController::class, 'index']);
Route::get('/relationsheep/topics/{slug}/posts', [PostController::class, 'postsByTopic']);

Route::prefix('/relationsheep')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

});




# Aufgaben Ackerer
Route::prefix('ackerer')->group(function () {
    Route::get('/plants', [PlantController::class, 'getPlants']);
    Route::get('/plants/{slug}', [PlantController::class, 'getPlant']);
    Route::get('/farmers', [PlantController::class, 'getFarms']);
});







Route::middleware('api')->group(function () {
    Route::resource('/r-rest/clowns', ClownController::class);
});

/*

GET /api/r-rest/clowns (maps to the index method, shows a list of clowns)
GET /api/r-rest/clowns/{id} (maps to the show method, shows a specific clown)
POST /api/r-rest/clowns (maps to the store method, creates a new clown)
PUT or PATCH /api/r-rest/clowns/{id} (maps to the update method, updates a specific clown)
DELETE /api/r-rest/clowns/{id} (maps to the destroy method, deletes a specific clown)

*/