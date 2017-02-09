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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('participante', 'ParticipanteController');

Route::resource('consorcio', 'ConsorcioController');
Route::get('consorcio/participante/{consorcio_id}/{participante_id}', 'ConsorcioController@addParticipante');

Route::resource('sorteio', 'SorteioController');

Route::get('sorteio/participantes/{consorcio_id}', 'SorteioController@participantes');
Route::get('sorteio/sortear/{consorcio_id}', 'SorteioController@sortear');
Route::get('sorteio/confirmar/{consorcio_id}/{participante_id}', 'SorteioController@confirmar');