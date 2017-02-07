<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UpnGenerator;

class MainSiteController extends Controller
{
	public function show()
	{
		$gen = new UpnGenerator;
		$gen->generatePermanent(16);
		$gen->generateTemp(16);
		return view('default.welcome');
	}
}