<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Item list/create/destroy Routes...
Route::get('/items', 'ItemController@index');
Route::post('/item', 'ItemController@store');
Route::delete('/item/{item}', 'ItemController@destroy');
Route::get('/items/feed', 'ItemController@feed');

// Action list/create/destroy Routes...
Route::get('/actions', 'ActionController@index');
Route::post('/action', 'ActionController@store');
Route::delete('/action/{action}', 'ActionController@destroy');
Route::get('/actions/feed', 'ActionController@feed');

// Item list/create/destroy Routes...
Route::get('/zones', 'ZoneController@index');
Route::post('/zone', 'ZoneController@store');
Route::delete('/zone/{zone}', 'ZoneController@destroy');
Route::get('/zones/feed', 'ZoneController@feed');

// Item list/create/destroy Routes...
Route::get('/variables', 'VariableController@index');
Route::post('/variable', 'VariableController@store');
Route::delete('/variable/{variable}', 'VariableController@destroy');
Route::get('/variables/feed', 'VariableController@feed');

Route::get('/helper-test', function() {
    return getRandomHex(16);
});
