<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UpnGenerator;
use App\User;

class HomeController extends Controller
{
	public function index()
	{
		if(User::count() > 0)
		{
			return redirect('dashboard');
		} else 
		{
			return redirect('register');
		}
	}

	public function dashboard(Request $request)
	{
		$userLevel = auth()->user()->userLevel();
		switch ($userLevel)
		{
			case 'super':
				# code...
				break;
			case 'staff':
				# code...
				break;
			case 'parent':
				# code...
				break;
			case 'student':
				return app('App\Http\Controllers\StudentController')->showStudentProfile($request, 0);
				break;
			default:
				break;
		}
		return view('default.index', ['title' => 'Dashboard']);
	}
}