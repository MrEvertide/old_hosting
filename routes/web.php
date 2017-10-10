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

/**
 * GET ROUTES
 */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/servers', 'ServerController@serverList')->name('serverList');
Route::get('/servers/add', 'ServerController@addServer')->name('serverAdd');
Route::get('/servers/view/{id}', 'ServerController@viewServer', function($id) {return $id;})->where('id', '[0-9]+')->name('serverView');
Route::get('/servers/delete/{id}', 'ServerController@deleteServer', function($id) {return $id;})->where('id','[0-9]+')->name('serverDelete');
Route::get('/refresh','HomeController@refreshDashboard')->name('refreshList');

/**
 * POST ROUTES
 */
Route::post('/servers/add', 'ServerController@addServerPost')->name('post_serverAdd');