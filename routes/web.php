<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Administradores

Route::post('administradorCreate','AdministradorController@createAdministrador');
Route::get('administradorHome','AdministradorController@homeAdministradores');
Route::get('administradorProfile/{username}','AdministradorController@administradorProfile');
Route::post('administradorProfile/{username}','AdministradorController@updateAdministrador');
Route::delete('administradorDelete/{username}','AdministradorController@deleteAdministrador');

// Utilizadores

Route::post('utilizadoresCreate','AdministradorController@createUtilizador');
Route::get('utilizadoresAll','AdministradorController@allUtilizadores');
Route::get('utilizadoresProfile/{iduser}','AdministradorController@utilizadorProfile');
Route::get('utilizadoresFind','AdministradorController@findUtilizador');
Route::post('utilizadoresProfile/{iduser}','AdministradorController@updateUtilizador');
Route::post('utilizadoresDelete/{iduser}','AdministradorController@deleteUtilizador');
Route::get('exportUsers','AdministradorController@exportUsers');
Route::post('importUsers','AdministradorController@importUsers');

// Propriedades

Route::post('propriedadesCreate','AdministradorController@createPropriedade');
Route::get('propriedadesAll','AdministradorController@allPropriedades');
Route::get('propriedadesProfile/{idpropriedade}','AdministradorController@propriedadeProfile');
Route::get('propriedadesFind','AdministradorController@findPropriedade');
Route::post('propriedadesProfile/{idpropriedade}','AdministradorController@updatePropriedade');
Route::post('propriedadesDelete/{idpropriedade}','AdministradorController@deletePropriedade');
Route::get('exportProperties','AdministradorController@exportProperties');
Route::post('importProperties','AdministradorController@importProperties');

// Establishments

Route::get('findEstablishment','AdministradorController@findEstablishment');
Route::get('createEstablishment','AdministradorController@establishments');
Route::get('establishmentProfile/{idestablishment}','AdministradorController@establishmentProfile');
Route::post('createEstablishmentFunction','AdministradorController@createEstablishment');
Route::post('deleteEstablishment/{idestablishment}','AdministradorController@deleteEstablishment');
Route::post('updateEstablishment/{idestablishment}','AdministradorController@updateEstablishment');
