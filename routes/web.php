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





Auth::routes();

Route::resource('modal','ModalController');

Route::get('/', 'HomeController@index')->middleware('auth');
Route::resource('supervisor','SupervisorController');
Route::resource('project','ProjectController');
Route::resource('task','TaskController');


//Route::get('/modal/card/{id}', 'ModalController@show');


//Route::get('/modal/test', 'ModalController@modal');
//Route::post('/modal/test', 'ModalController@store');
//Route::get('/modal/test', 'ModalController@show');
//Route::get('/modal/test/{id}', 'ModalController@edit');
//Route::put('/modal/test', 'ModalController@update');


// Route::get('/forms', 'FormController@index');
// Route::post('/forms', 'FormController@store');
// Route::get('/forms/create', 'FormController@create');
// Route::get('/forms/create', 'FormController@show');