<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Subject;

class ClassCloudController extends Controller
{
	public function dashboard(Request $request)
	{
		$user = auth()->user();
		switch($user->userLevel())
		{
			case 3:
			//staff
				$classes = $user->staff->role == 'teacher' ? $user->staff->classes : $_ENV['school']->classes;
				return view('classcloud.teacher-dashboard', ['classes' => $classes]);
				break;
			case 2:
			//guardian
				$students = $user->guardian->students()->with('class')->get();
				return view('classcloud.parent-dashboard', ['students' => $students]);
				break;
			case 1:
				return redirect('classcloud/'.$user->student->class->class_form);
				break;
			default:
				abort(403);
			
		}
	}

	public function classDashboard(Request $request, $classForm)
	{
		$subjects = Subject::all();
		return view('classcloud.dashboard', ['subjects' => $subjects, 'title' => 'ClassCloud']);
	}


	public function subjectDashboard(Request $request, $classForm, $subject)
	{
		$subject = Subject::where('name', $subject)->with(['resources' => function ($query) use ($classForm) {
			$query->whereHas('classes', function ($query) use ($classForm) {
				$query->where('class_form', $classForm);
			});
		}])->first();
		return view('classcloud.subject-dashboard', ['resources' => $subject->resources]);
	}
}
