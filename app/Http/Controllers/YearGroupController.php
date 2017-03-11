<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class YearGroupController extends Controller
{
	public function calculate(Request $request)
	{
		$receptionEndAge = 5;
		$minSchoolYear = -1;
		$maxSchoolYear = 14;
		$dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'));
		$aug = Carbon::parse('31 august this year');
		$age = $dob->diffInYears(Carbon::now());
		$yearGroup = $dob->diffInYears($aug) - $receptionEndAge;

		if($maxSchoolYear < $yearGroup || $yearGroup < $minSchoolYear)
			return response()->json(['error' => 'Date of Birth out of age range'], 422);

		return response()->json(['age' => $age, 'yearGroup' => $yearGroup]);

	}
}
