<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\UpnFactory;
use App\Model\RegistrationPeriod;
use App\Model\AttainmentAverage;
use App\Model\AttainmentPeriod;
use App\Model\AttainmentGrade;
use App\Model\Student;
use App\Model\YearGroup;
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
		$weekStart = Carbon::parse('monday this week');
		$monthStart = Carbon::parse('first day of this month');

		$possiblePeriodsYear = $this->attendancePeriods($student);
		$possiblePeriodsWeek = $this->attendancePeriods($student, $weekStart);
		$possiblePeriodsMonth = $this->attendancePeriods($student, $monthStart);

		$studentAttendanceBuilder = $student->attendance->whereIn('code', ['/', 'L', '\\'])->where('date', '<', Carbon::today());
		$studentYear = $studentAttendanceBuilder->count();
		$studentWeek = $studentAttendanceBuilder->where('date', '>=', $weekStart)->count();
		$studentMonth = $studentAttendanceBuilder->where('date', '>=', $monthStart)->count();
		$percentage['year'] = division($studentYear, $possiblePeriodsYear);
		$percentage['week'] = division($studentWeek, $possiblePeriodsWeek);
		$percentage['month'] = division($studentMonth, $possiblePeriodsMonth);

		$attainment['grades'] = AttainmentGrade::all()->pluck('code');
		$attainment['periods'] = AttainmentPeriod::all()->pluck('name');
		$attainment['target'] =  $student->attainmentTargets()->with('attainmentGrade')->with('subject')->get();
	
		$attainment['student'] = $student->attainment()->whereHas('attainmentPeriod', function($query) {
			$query->where('milestone', '<=', Carbon::today());
		})->with(['attainmentPeriod' => function($query) {
			$query->orderBy('milestone', 'asc');
		}])->with('attainmentGrade')->with('subject')->get();

		$attainment['averages'] = AttainmentAverage::whereHas('attainmentPeriod', function($query) {
			$query->where('milestone', '<=', Carbon::today());
		})->with(['attainmentPeriod' => function($query) {
				$query->orderBy('milestone', 'asc');
		}])->with('attainmentGrade')->with('subject')->get();

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
		return view('student.edit', ['url' => 'students/add', 'title' => 'Add Student Manually', 'acYear' => YearGroup::all()]);
	}

	public function showEditForm(Request $request, $id)
	{
		$student = $_ENV['school']->students()->findOrFail($id);
		return view('student.edit', ['student' => $student, 'url' => url()->current(), 'title' => 'Editing '.$student->legal_forename.' '.$student->legal_surname, 'acYear' => YearGroup::all()]);
	}

	public function add(Request $request)
	{
		validate_password($request->only(['password', 'password_confirmation']));
		$info = $request->except('_token', 'upn', 'manual-upn-textfield', 'arrival_date', 'username', 'password', 'password_confirmation');
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
		$user = createUser($request->only(['username', 'password']));
		$student->user()->save($user);
		$_ENV['school']->students()->attach($student->id, ['arrival_date' => $arrivalDate]);
		return redirect('student/'.$student->id);
	}

	public function edit(Request $request, $id)
	{
		$info = $request->except('_token', 'upn', 'manual-upn-textfield', 'arrival_date', 'username', 'password', 'password_confirmation');
		$info['dob'] = Carbon::createFromFormat('d/m/Y', $info['dob']);
		$student = $_ENV['school']->students()->findOrFail($id);
		$arrivalDate = Carbon::createFromFormat('d/m/Y', $request->input('arrival_date'));
		$_ENV['school']
			->students()
			->updateExistingPivot($student->id, ['arrival_date' => $arrivalDate]);
		$userInfo['username'] = $request->input('username');
		if (!empty($request->input('password')))
		{
			validate_password($request->only(['password', 'password_confirmation']));
			$userInfo['password'] = $request->input('password');
		}
		if($student->user)
		{
			if(!empty($request->input('password')))
				$userInfo['password'] = bcrypt($userInfo['password']);
			$student->user()->update($userInfo);
		} else {
			$user = createUser($request->only(['username', 'password']));
			$student->user()->save($user);
		}
		$student->update($info);
		return redirect('student/'.$student->id);
	}

	protected function attendancePeriods($student, Carbon $dt = null)
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