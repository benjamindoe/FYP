<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use Carbon\Carbon;
use App\UpnFactory;

class StudentController extends Controller
{
	public function showAddForm()
	{
		return view('student.edit', ['url' => 'students/add', 'title' => 'Add Student Manually']);
	}

	public function add(Request $request)
	{
		$info = $request->except('_token', 'upn', 'manual-upn-textfield', 'arrival_date', 'preferred_forname');
		$info['dob'] = Carbon::createFromFormat('d/m/Y', $info['dob']);
		$info['preferred_forename'] = $request->input('preferred_forname');
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
}
