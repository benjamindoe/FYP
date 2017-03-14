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

Route::get('home', function()
{
	return redirect('/');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function()
{
	Route::any('dashboard', 'HomeController@dashboard')->name('home');
});

Route::get('profile/{username}', 'Controllre@method');

Route::group(['prefix' => 'students', 'middleware' => 'auth.staff:admin'], function()
{
	Route::get('import/ATF', 'StudentController@method');
	Route::get('import/CTF', 'StudentController@method');
	Route::get('export/CTF', 'StudentController@method');
	Route::get('add', 'StudentController@showAddForm');
	Route::post('add', 'StudentController@add');
	Route::get('/', 'StudentController@listStudents');
});

Route::group(['prefix' => 'student/{id}', 'middleware' => 'auth.level:student'], function()
{
	Route::get('/', 'StudentController@showStudentProfile');
	Route::get('attendance/history', 'StudentController@method')->name('attendance');
	Route::get('attainment/history', 'StudentController@method')->name('attainment');
	Route::get('edit', 'StudentController@showEditForm')->middleware('auth.staff:admin');
	Route::put('edit', 'StudentController@edit')->middleware('auth.staff:admin');
});

Route::group(['prefix' => 'schools', 'middleware' => 'auth.level:super'], function()
{
	Route::any('/', 'SchoolController@showSchoolsList');
	Route::get('add', 'SchoolController@showAddForm');
	Route::post('add', 'SchoolController@add');
	Route::get('{id}', 'SchoolController@showSchoolInfo');
	Route::get('{id}/edit', 'SchoolController@showEditForm');
	Route::put('{id}/edit', 'SchoolController@edit');
	Route::delete('{id}/delete', 'SchoolController@delete');
	Route::group(['prefix' => '{urn}/staff'], function()
	{
		Route::any('/', 'StaffController@showSchoolStaffList');
		Route::get('add', 'StaffController@showSchoolStaffAddForm');
		Route::post('add', 'StaffController@addSchoolsStaff');
		Route::get('{username}', 'StaffController@showSchoolsStaffProfile');
		Route::get('{username}/edit', 'StaffController@showSchoolStaffEditForm');
		Route::put('{id}/edit', 'StaffController@editSchoolStaff');
		Route::delete('{id}/delete', 'StaffController@deleteSchoolStaff');
	});
});

Route::group(['prefix' => 'staff', 'middleware' => 'auth.explicit:staff'], function()
{
	Route::get('/', 'StaffController@showStaffList');
	Route::get('add', 'StaffController@showAddForm');
	Route::post('add', 'StaffController@addStaff');
	Route::get('{username}', 'StaffController@showStaffProfile');
	Route::get('{username}/edit', 'StaffController@showEditForm');
	Route::put('{id}/edit', 'StaffController@editStaff');
	Route::delete('{id}/delete', 'StaffController@delete');
});

Route::group(['prefix' => 'school', 'middleware' => 'auth.explicit:staff'], function()
{
	Route::get('/', 'SchoolController@showSchoolInfo');
	Route::get('edit', 'SchoolController@showEditForm');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.staff:admin'], function()
{
	//Route::get();
});
Route::group(['prefix' => 'attendance'], function()
{
	
});

Route::group(['prefix' => 'class', 'middleware' => 'auth.explicit:staff'], function()
{
	Route::get('{form}/register', 'ClassController@showRegForm');
	Route::post('{form}/register', 'ClassController@classRegistration');
	Route::group(['middleware' => 'auth.staff:admin'], function()
	{
		Route::get('add', 'ClassController@showAddForm');
		Route::post('add', 'ClassController@add');
		Route::get('{year}/{form}/edit', 'ClassController@showEditForm');
		Route::put('{year}/{form}/edit', 'ClassController@edit');
		Route::delete('{year}/{form}/delete', 'ClassController@delete');
		Route::get('{year?}', 'ClassController@listClasses');
	});
});

Route::group(['prefix' => 'vle', 'middleware' => 'auth.level:student'], function()
{
	Route::get('/', 'VleController@dashboard');
	Route::get('{subject}', 'VleController@subjectDashboard');
	Route::get('{subject}/{asset}', 'VleController@asset');
	Route::get('{subject}/{asset}/download', 'VleController@download');
});

Route::group(['prefix' => 'academic-years', 'middleware' => 'auth.staff:admin'], function()
{
	Route::get('/', 'AcademicYearsController@overview');
	Route::get('add', 'AcademicYearsController@showAddForm');
	Route::get('{year}/edit', 'AcademicYearsController@showEditForm');
	Route::post('add', 'AcademicYearsController@add');
	Route::post('{year}/edit', 'AcademicYearsController@edit');
	Route::delete('{year}/delete', 'AcademicYearsController@edit');
});


Route::group(['prefix' => 'year-group', 'middleware' => 'auth.staff:admin'], function()
{
	Route::get('calculate', 'YearGroupController@calculate');
});