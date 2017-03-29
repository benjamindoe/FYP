<?php

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\Attendance;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::any('/register', function (Request $request) {
	$period = Carbon::now() < Carbon::parse('today 12pm') ? 'am' : 'pm';
	$student = Student::where('rfid', $request->input('tagid'))->first();
	$att = $student->attendance()->firstOrnew(['date' => Carbon::today(), 'period' => $period]);
	$att->class_id = $student->class_id;
	$att->notes = '';
	$att->code = $period == 'am' ? '/' : '\\';
	$att->save();
	return response()->json(['success' => true, 'regStudent' => $student->fullname, 'regStudentId' => $student->id, 'code' => $att->code]);
})->middleware('cors');