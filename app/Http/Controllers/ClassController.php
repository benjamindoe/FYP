<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Classes;

class ClassController extends Controller
{
    public function listClasses(Request $request)
    {
    	dd(Classes::all());
    	return view();
    }
}
