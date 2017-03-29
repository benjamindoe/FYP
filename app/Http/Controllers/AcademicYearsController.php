<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AcademicYear;
use Carbon\Carbon;

class AcademicYearsController extends Controller
{
	public function __construct() {}

	public function overview(Request $request)
	{
		return view('academic-years.listviewer', ['academicYears' => $_ENV['school']->academicYears, 'url' => 'academic-years', 'title' => 'Academic Years']);
	}

	public function showAddForm(Request $request)
	{
		return view('academic-years.edit', ['url' => 'academic-years/add', 'title' => 'Add Academic Year']);
	}

	public function add(Request $request)
	{
		$info = $request->only(['academic_year', 'year_start', 'year_end']);
		$info['year_start'] = Carbon::createFromFormat('d/m/Y', $info['year_start']);
		$info['year_end'] = Carbon::createFromFormat('d/m/Y',  $info['year_end']);
		$academicYear = new AcademicYear($info);
		$_ENV['school']->academicYears()->save($academicYear);
		if($request->ajax())
			return Response::json(['success' => true, 'academicYear' => $academicYear]);
		return redirect('academic-years');
	}
}
