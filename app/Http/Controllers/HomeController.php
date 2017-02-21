<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UpnGenerator;


class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
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