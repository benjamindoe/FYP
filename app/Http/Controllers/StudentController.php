<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use Carbon\Carbon;
use App\UpnFactory;
use App\Model\RegistrationPeriod;
use App\Model\AttainmentGrade;
use App\Model\AttainmentPeriod;

class StudentController extends Controller
{
	public function showStudentProfile(Request $request, int $id)
	{
		$user = auth()->user();
		switch(auth()->user()->role())
		{
			case 'student':
				$student = auth()->user()->student()->with('attendance');
				break;
			case 'guardian':
				$student = auth()->user()->guardian->students()->with('attendance')->findOrFail($id);
				break;
			case 'staff':
				$student = $_ENV['school']->students()->with('attendance')->findOrFail($id);
				break;
			default:
				abort(404);
				break;
		}
		$possiblePeriodsYear = $this->attendancePeriods($student);
		$weekStart = Carbon::parse('monday this week');
		$monthStart = Carbon::parse('first day of this month');
		$possiblePeriodsWeek = $this->attendancePeriods($student, $weekStart);
		$possiblePeriodsMonth = $this->attendancePeriods($student, $monthStart);

		$studentAttendanceBuilder = $student->attendance->whereIn('code', ['/', 'L', '\\'])->where('date', '<', Carbon::today());
		$studentYear = $studentAttendanceBuilder->count();
		$studentWeek = $studentAttendanceBuilder->where('date', '>=', $weekStart)->count();
		$studentMonth = $studentAttendanceBuilder->where('date', '>=', $monthStart)->count();
		$percentage['year'] = $studentYear / $possiblePeriodsYear;
		$percentage['week'] = $studentWeek / $possiblePeriodsWeek;
		$percentage['month'] = $studentMonth / $possiblePeriodsMonth;

		$attainment['grades'] = AttainmentGrade::all()->pluck('code');
		$attainment['periods'] = AttainmentPeriod::all()->pluck('name');
		$attainment['student'] = $student->attainment()->whereHas('attainmentPeriod', function($query) {
			$query->orderBy('milestone', 'asc');
		})->with('attainmentGrade')->with('subject')->get();
		$attainment['target'] =  $student->attainmentTargets()->with('attainmentGrade')->with('subject')->get();
		return view('student.profile', ['student' => $student, 'attendancePercent' => $percentage, 'attainment' => $attainment]);
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

	private function attendancePeriods($student, Carbon $dt = null)
	{
		$dt = $dt ?? $student->school->academicYears()->current()->first()->year_start;
		$dt2 = Carbon::today();
		$days = $dt->diffInWeekdays($dt2);
		$possiblePeriods = $days * RegistrationPeriod::count();
		$impossibleAttendance = $student->attendance->whereIn('code', ['D, X, Y, Z, #'])->count();
		$possiblePeriods -= $impossibleAttendance;
		return $possiblePeriods;
	}
}