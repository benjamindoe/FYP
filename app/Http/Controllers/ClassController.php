<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Classes;

class ClassController extends Controller
{
    public function listClasses(Request $request)
    {
    	$classes = $_ENV['school']->classes;
    	return view('class.listviewer', ['classes' => $classes, 'url' => 'class']);
    }

    public function showAddForm(Request $request)
    {
    	$teachers = $_ENV['school']->staff()->whereIn('role', ['teacher', 'headteacher'])->get();
    	return view('class.edit', ['url' => 'class/add', 'teachers' => $teachers, 'students' => []]);
    }

    public function addClass(Request $request)
    {

    }

    public function showEditForm(Request $request, string $form)
    {
		$class = $_ENV['school']->classes()->where('class_form', $form)->first();
    }

    public function editClass(Request $request, string $form)
    {
		$class = $_ENV['school']->classes()->where('class_form', $form)->first();
    	# code...
    }
}
