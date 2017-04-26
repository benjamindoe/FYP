<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class YearGroupController extends Controller
{
	public function calculate(Request $request)
	{

		$dob = Carbon::createFromFormat('d/m/Y', $request->input('dob'));
		$yearGroup = calculateYearGroup($dob);
		if($yearGroup)
			return response()->json($yearGroup);

		return response()->json(['error' => 'Date of Birth out of age range'], 422);


	}
}
