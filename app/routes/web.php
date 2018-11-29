<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

/* 
------------------------------------------------------
Middleware security
------------------------------------------------------
*/

//http://localhost:8000/admin
Route::group(['middleware' => 'auth'], function() 
{ // si esta logueado...
    Route::group(['middleware' => 'security'], function() 
    { // si es un rol de usuario autorizado para acceder a la ruta...
        Route::get('/admin', function () {
            return "Página Administracion, Ruta protegida...";
        });
    });
});

/*
------------------------------------------------------
Test de rutas
------------------------------------------------------
*/

//http://localhost:8000
Route::get('/', 'IndexController@index');

//http://localhost:8000/precio/25
Route::get('/precio/{valor}', [
    'as'   => 'precio',
    'uses' => 'IndexController@listarprecio'
]);

//http://localhost:8000/test
Route::get('/usertest/{id}', function ($id) {
    $user = App\User::find($id);
    return $user->toJson();
    return $user->toJson(JSON_PRETTY_PRINT);
});

//http://localhost:8000/test
Route::get('/usertest', function () {
    $user = App\User::all();
    return $user->toJson();
    return $user->toJson(JSON_PRETTY_PRINT);
});

//http://localhost:8000/test/10
Route::get('/test/{id}', function ($id) {
    return "Página Testing de Ruta... con un parametro: " . $id;
});

//http://localhost:8000/test/10/pepe
Route::get('/test/{id}/{nombre}', function ($id,$nombre) {
    return "Página Testing de Ruta... con un parametro: " . $id . " y nombre " . $nombre;
})->where('nombre','[a-zA-Z]+');


/* 
------------------------------------------------------
Rutas especiales utilizadas por Laravel 
para autentificacion de usuarios.
------------------------------------------------------
*/


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
