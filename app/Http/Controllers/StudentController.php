<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use Carbon\Carbon;
use App\UpnFactory;

class StudentController extends Controller
{
	public function showStudentProfile(Request $request, int $id)
	{
		$user = auth()->user();
		switch(auth()->user()->role())
			{
				case 'student':
					$student = auth()->user()->student;
					break;
				case 'guardian':
					$student = auth()->user()->guardian->students()->findOrFail($id);
					break;
				case 'staff':
					$student = $_ENV['school']->students()->findOrFail($id);
					break;
				default:
					abort(404);
					break;
			}
		dd($student);
		return view('student.profile');
	}
	public function listStudents(Request $request)
	{
		$query = $request->input();
		$students = Student::where($query)->get();
		return view('student.listviewer', ['students' => $students, 'url' => url()->current(), 'title' => 'Students']);
	}

	public function showAddForm()
	{
		return view('student.edit', ['url' => 'students/add', 'title' => 'Add Student Manually']);
	}

	public function showEditForm(Request $request, $id)
	{
		$student = $_ENV['school']->students()->findOrFail($id);
		return view('student.edit', ['student' => $student, 'url' => url()->current(), 'title' => 'Editing '.$student->legal_forename.' '.$student->legal_surname]);
	}

	public function add(Request $request)
	{
		$info = $request->except('_token', 'upn', 'manual-upn-textfield', 'arrival_date');
		$info['dob'] = Carbon::createFromFormat('d/m/Y', $info['dob']);
		$arrivalDate = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date'));
		$upn = new UpnFactory($arrivalDate);
		switch($request->input('upn'))
		{
			case 1:
				$upn->generatePermanent()->save();
				break;
			case 2:
				$upn->generatePermanent()->save();
				break;
			case 3:
				$upn = UpnFactory::Upn($request->input('manual-upn-textfield'))->save();
				break;
			default:
				dd(false);
				break;
		}
		$info['upn'] = $upn->getUpn();
		$student = Student::create($info);
		$_ENV['school']->students()->attach($student->id, ['arrival_date' => $arrivalDate]);
		return redirect('student/'.$student->id);
	}

	public function edit(Request $request, $id)
	{
		$info = $request->except('_token', 'upn', 'manual-upn-textfield', 'arrival_date');
		$info['dob'] = Carbon::createFromFormat('d/m/Y', $info['dob']);
		$student = $_ENV['school']->students()->findOrFail($id);
		$student->update($info);
		$arrivalDate = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date'));
		$_ENV['school']
			->students()
			->updateExistingPivot($student->id, ['arrival_date' => $arrivalDate]);
		return redirect('student/'.$student->id);
	}
}
