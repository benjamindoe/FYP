<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

	public function dashboard()
	{
		$userLevel = Auth::user()->userLevel();
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
			default:
				# code...
				break;
		}
		$gen = new UpnGenerator;
		$gen->generatePermanent(16);
		$gen->generateTemp(16);
		return view('default.index');
	}
}