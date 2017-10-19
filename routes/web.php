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

//SETUP ROUTES
Route::get('/setup/team', 'SetupController@createTeam')->name('setup@createTeam');
Route::post('/setup/team', 'SetupController@createTeamPost')->name('post_createTeam');

//ALL ROUTES
//Accessible only once the user has completed the setup process.
Route::group(['middleware' => 'App\Http\Middleware\SetupMiddleware'], function() {
    //GET ROUTES
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/refresh','HomeController@refreshDashboard')->name('refreshList');


    //ADMIN ROUTES
    //Accessible only for team admins
    Route::group(['middleware' => 'App\Http\Middleware\AdminTeamMiddleware'], function() {

        //TEAM MANAGEMENT
        Route::get('/admin/team', 'TeamController@listTeamMember')
            ->name('admin@listTeamMember');

        Route::get('/admin/team/add', 'TeamController@addTeamMember')
            ->name('admin@addTeamMember');

        Route::post('/admin/team/add', 'TeamController@addTeamMemberPost')
            ->name('admin@addTeamMemberPost');

        Route::get('/admin/team/view/{id}', 'TeamController@viewTeamMember', function($id) {return $id;})
            ->where('id', '[0-9]+')
            ->name('admin@viewTeamMember');

        Route::post('/admin/team/delete/{id}', 'TeamController@deleteTeamMember', function($id) {return $id;})
            ->where('id', '[0-9]+')
            ->name('admin@deleteTeamMember');

        //SERVER MANAGEMENT
        Route::get('/admin/server', 'ServerController@serverList')
            ->name('admin@listServer');

        Route::get('/admin/server/add', 'ServerController@addServer')
            ->name('admin@addServer');

        Route::post('/admin/server/add', 'ServerController@addServerPost')
            ->name('admin@addServerPost');

        Route::get('/admin/server/view/{id}', 'ServerController@viewServer', function($id) {return $id;})
            ->where('id', '[0-9]+')
            ->name('admin@viewServer');

        Route::get('/admin/server/delete/{id}', 'ServerController@deleteServer', function($id) {return $id;})
            ->where('id','[0-9]+')
            ->name('admin@deleteServer');
    });

});