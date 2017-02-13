<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UpnGenerator;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('staff');
	}

	public function index()
	{
		$gen = new UpnGenerator;
		$gen->generatePermanent(16);
		$gen->generateTemp(16);
		return view('default.index');
	}
}