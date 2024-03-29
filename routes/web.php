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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{edad}/{sexo?}/{nombre?}', 'Prueba\PruebaController@prueba')
// ->where([
//     'edad' => '[0-9]+',
//     'sexo' => '[a-zA-Z]+',
//     'nombre' => '[a-z]+'
// ]);

Route::get('/', 'Prueba\PruebaController@index');

Route::post('/data', 'Prueba\PruebaController@data');
Route::put('/dataUpdate/{id}', 'Prueba\PruebaController@dataUpdate')->name('dataUpdate');
Route::delete('/dataDelete/{id}', 'Prueba\PruebaController@dataDelete')->name('dataDelete');

// Sessions
Route::post('/add', 'Prueba\PruebaController@add');
Route::delete('/delete/{id}', 'Prueba\PruebaController@delete')->name('delete');
Route::put('/update/{id}', 'Prueba\PruebaController@update')->name('update');

// Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');