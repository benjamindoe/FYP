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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function() {
	return redirect('/');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::get('profile/{username}', 'Controllre@method');

Route::group(['prefix' => 'student/{id}'], function() {
	Route::get('/', 'Controllre@method');
	Route::get('attendance/history', 'Controllre@method');
	Route::get('attainment/history', 'Controllre@method');
});

Route::group(['prefix' => 'school'], function(){
	Route::get('add', 'SchoolController@showAddForm');
	Route::post('add', 'SchoolController@add');
	Route::get('edit/{id}', 'SchoolController@showEditForm');
	Route::put('edit/{id}', 'SchoolController@edit');
	Route::delete('delete/{id}', 'SchoolController@delete');
});
Route::group(['prefix' => 'attendance'], function(){
	
});

Route::group(['prefix' => 'class/{class}'], function(){
	Route::get('register', 'Controllre@method');
	Route::get('/', 'Controllre@method');
});