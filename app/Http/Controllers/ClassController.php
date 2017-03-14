<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Model\Classes;
use App\Model\Student;
use App\Model\RegistrationPeriod;
use App\Model\Attendance;
use App\Model\AttendanceCode;

class ClassController extends Controller
{
	public function listClasses(Request $request, $year = null)
	{
		$classes = $_ENV['school']->classes()->with('teachers');
		if($year)
		{
			$classes->whereHas('academicYear', function($query) use ($year) {
				$query->where('academic_year', $year);
			});
		}
		$classes = $classes->with('academicYear')->get();
		return view('class.listviewer', ['classes' => $classes, 'url' => 'class', 'title' => 'Classes']);
	}

	public function showAddForm(Request $request)
	{
		$teachers = $_ENV['school']->staff()->whereIn('role', ['teacher', 'headteacher'])->get();
		$students = $_ENV['school']->students;
		return view('class.edit', [ 'teachers' => $teachers, 'students' => $students, 'title' => 'Add Class']);
	}

	public function add(Request $request)
	{
		$classInfo = $request->only(['class_form', 'academic_year']);
		$teachers = $request->input('teachers');
		$students = $request->input('students');
		$class = $_ENV['school']->classes()->create($classInfo);
		if($teachers)
		{
			$class->teachers()->sync($teachers);
		}
		if($students)
		{
			$students = Student::find($students);
			$class->students()->saveMany($students);
		}
		return redirect('class');
	}

	public function showEditForm(Request $request, string $year, string $form)
	{
		$class = $this->classFinder($year, $form)->with('teachers')->with('students')->firstOrFail();
		$teachers = $_ENV['school']->staff()->whereIn('role', ['teacher', 'headteacher'])->get();
		return view('class.edit', ['class' => $class, 'teachers' => $teachers, 'students' => $_ENV['school']->students, 'title' => 'Editing '.$class->class_form, 'edit' => true]);
	}

	public function edit(Request $request, string $year, string $form)
	{
		$info = $request->only(['class_form', 'academic_year']);
		$teachers = $request->input('teachers');
		$students = $request->input('students');

		$class = $this->classFinder($year, $form)->first();
		$class->update($info);
		if($teachers)
		{
			$class->teachers()->sync($teachers);
		}
		if($students)
		{
			$class->students()->whereNotIn('id', $students);
			$students = Student::find($students);
			$class->students()->saveMany($students);
		}
		return view('class/'.$class->academicYear->year_group.'/'.$class->year_form);
	}

	public function delete(Request $request, string $year, string $form)
	{
		$class = $this->classFinder($year, $form)->delete();

		if($request->ajax())
			return response()->json(['success' => true]);

		return back();
	}

	public function showRegForm(Request $request, $classForm)
	{
		$class = $_ENV['school']->classes()->where('class_form', $classForm)->whereHas('academicYear', function($query) {
			$query
				->where('year_start', '<=', Carbon::now())
				->where('year_end', '>=', Carbon::now());
		})->with(['students' => function($query) {
			$query->with(['attendance' => function($query) {
					$query->where('date', Carbon::now());
				}]);
		}])->first();
		$codes = AttendanceCode::all();
		return view('class.register', ['class' => $class, 'periods' => RegistrationPeriod::all(), 'title' => $class->class_form.' Registration', 'codes' => $codes]);
	}

	public function classRegistration(Request $request, $classForm)
	{
		$date = $request->input('date') !== null ? Carbon::parse($request->input('date')) : Carbon::now();
		foreach($request->input('student') as $studentId => $student)
		{
			dump($student);
			foreach ($student as $key => $register)
			{
				if(!empty($register['code']))
					$record = Attendance::firstOrnew(['date' => $date, 'period' => $key]);

				dump($record);
			}
		}
		dd($request->all());
		return;
	}

	protected function classFinder($year, $form)
	{
		return $_ENV['school']->classes()->where('class_form', $form)
			->whereHas('academicYear', function($query) use ($year) {
				$query->where('academic_year', $year);
			});
	}

	/**
	 * Get a validator for an incoming class request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'class_form'=> 'required|unique_with:class, academic_year',
		]);
	}
}
