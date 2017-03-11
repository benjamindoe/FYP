<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Classes;
use App\Model\Student;

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
		$class = $this->classFinder($year, $form)->with('teachers')->with('students')->first();
		$teachers = $_ENV['school']->staff()->whereIn('role', ['teacher', 'headteacher'])->get();
		return view('class.edit', ['class' => $class, 'teachers' => $teachers, 'students' => $_ENV['school']->students, 'title' => 'Editing '.$class->class_form, 'edit' => true]);
	}

	public function edit(Request $request, string $year, string $form)
	{
		$teachers = (array)$request->input('teachers');
		$students = (array)$request->input('students');
		$class = $this->classFinder($year, $form)->first();
		if($teachers)
		{
			$class->teachers()->sync($teachers);
		}
	}

	public function delete(Request $request, string $year, string $form)
	{
		$class = $this->classFinder($year, $form)->delete();

		if($request->ajax())
			return response()->json(['success' => true]);

		return back();
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
			'username'	=> 'required|max:255|unique:users',
			'forename'	=> 'required',
			'surname'	=> 'required',
		]);
	}
}
