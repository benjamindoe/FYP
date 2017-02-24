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
Route::get('/', 'HomeController@index');

Route::get('home', function() {
	return redirect('/');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function() {
	Route::any('dashboard', 'HomeController@dashboard')->name('home');
});

Route::get('profile/{username}', 'Controllre@method');

Route::group(['prefix' => 'student/{id}', 'middleware' => 'auth.level:student'], function() {
	Route::get('/', 'Controllre@method');
	Route::get('attendance/history', 'Controllre@method')->name('attendance');
	Route::get('attainment/history', 'Controllre@method')->name('attainment');

});

Route::group(['prefix' => 'schools', 'middleware' => 'auth.level:super'], function() {
	Route::get('add', 'SchoolController@showAddForm');
	Route::post('add', 'SchoolController@add');
	Route::get('edit/{id}', 'SchoolController@showEditForm');
	Route::put('edit/{id}', 'SchoolController@edit');
	Route::delete('delete/{id}', 'SchoolController@delete');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth.level:staff'], function() {
	//Route::get();
});
Route::group(['prefix' => 'attendance'], function(){
	
});

Route::group(['prefix' => 'class/{class}', 'middleware' => 'auth.level:staff'], function() {
	Route::get('register', 'Controllre@method')->name('register');
	Route::get('/', 'Controllre@method');
});

Route::group(['prefix' => 'vle', 'middleware' => 'auth.level:student'], function() {
	Route::get('/', 'VleController@dashboard');
	Route::get('{subject}', 'VleController@subjectDashboard');
	Route::get('{subject}/{asset}', 'VleController@asset');
	Route::get('{subject}/{asset}/download', 'VleController@download');
});