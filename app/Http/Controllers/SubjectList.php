<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Subject;

class SubjectList extends Controller
{
	public function __invoke(Request $request)
	{
		return view('subjects.list', ['subjects' => Subject::all()]);
	}
}
