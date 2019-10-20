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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/administracion','HomeController@administracion');
    Route::get('administracion/roles_ajax', 'RolController@roles_ajax'); 
    Route::resource('administracion/roles', 'RolController'); 
    Route::resource('administracion/usuarios', 'UserController');
    Route::get('administracion/usuarios_ajax', 'UserController@usuarios_ajax');  
    Route::post('administracion/buscar_cedula_usuario', ['as'=>'buscar_cedula_usuario','uses'=>'UserController@buscar_cedula_usuario']);
    Route::post('administracion/buscar_email_usuario', ['as'=>'buscar_email_usuario','uses'=>'UserController@buscar_email_usuario']);
    
});