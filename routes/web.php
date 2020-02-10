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

Route::get('match/{id}/live', 'ScoreController@viewLive')->name('score.viewLive');
Route::get('guest/live', 'GuestController@live')->name('guest.Live');
Route::get('guest/all', 'GuestController@all')->name('guest.All');

Route::group(['middleware' => 'auth'], function () {
	
	Route::group(['middleware' => 'role'], function () {
		Route::get('/home', 'HomeController@index')->name('home');
		Route::resource('user', 'UserController', ['except' => ['create', 'edit']]);
		Route::resource('arbitre', 'ArbitreController', ['except' => ['create', 'edit']]);
	});
	
	Route::get('match/live', 'MatchController@liveIndex')->name('match.liveIndex');
	Route::resource('match', 'MatchController', ['except' => ['create', 'edit']]);
	
	// scoring system
	Route::get('match/{id}/control', 'ScoreController@viewControl')->name('score.viewControl');

	// update database
	Route::post('match/{id}/status', 'ScoreController@status')->name('score.status');
	Route::post('match/{id}/set-score', 'ScoreController@set')->name('score.set');
});
