<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AcademicYear;
use App\Model\AttainmentGrade;
use App\Model\AttainmentPeriod;
use App\Model\AttainmentRecord;
use App\Model\AttainmentTarget;
use App\Model\Subject;
use Carbon\Carbon;

class AttainmentController extends Controller
{
	public function redirectToSubject(Request $request)
	{
		$subject = Subject::first();
		return redirect(url()->current().'/'.$subject->name);
	}

	public function showClassAttainmentRecord(Request $request, $classForm, $subject, $message = null)
	{
		$curSubject = Subject::where('name', $subject)->first();
		$curSchoolYear = AcademicYear::current()->first();
		$periods = AttainmentPeriod::whereBetween('milestone', [$curSchoolYear->year_start, $curSchoolYear->year_end])->get();
		return view('class.attainment', ['class' => $this->getClass($classForm, $curSubject->id)->first(), 'periods' => $periods, 'subjects' => Subject::all(), 'curSubject' => $curSubject, 'toastMessage' => $message, 'grades' => AttainmentGrade::orderBy('precedence', 'desc')->get()]);
	}

	public function saveClassAttainment(Request $request, $classForm, $subject)
	{
		$subject = Subject::where('name', $subject)->first();
		foreach($request->input('student') as $studentId => $student)
		{
			foreach ($student as $key => $value)
			{
				if($key === 'target' && !empty($value))
				{
					$record = AttainmentTarget::firstOrnew(['student_id' => $studentId, 'subject_id' => $subject->id]);
					$record->grade = $value;
					$record->save();
				}
				else if(!empty($value['grade']))
				{
					$record = AttainmentRecord::firstOrnew(['period' => $key, 'student_id' => $studentId, 'subject_id' => $subject->id]);
					$record->grade = $value['grade'];
					$record->save();
				}
			}
		}
		return $this->showClassAttainmentRecord($request, $classForm, $subject->name, 'Saved');
	}

	public function showAdminForm(Request $request)
	{
		return view('admin.attainment', ['grades' => AttainmentGrade::orderBy('precedence', 'desc')->get()]);
	}

	private function getClass($classForm, $subjectId)
	{
		$class = $_ENV['school']->classes()
			->where('class_form', $classForm)
			->whereHas('academicYear', function($query)
			{
				$query->where('year_start', '<=', Carbon::today())
					  ->where('year_end'  , '>=', Carbon::today());
			})
			->with([ 'students' => function($query) use ($subjectId)
			{
				$query->with(['attainment' => function($query) use ($subjectId)
				{
					$query->where('subject_id', $subjectId);
				}]);
				$query->with(['attainmentTargets' => function($query) use ($subjectId)
				{
					$query->where('subject_id', $subjectId);
				}]);
			}]);
		return $class;
	}
}
