<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Classes;
use App\Model\Student;

class ClassController extends Controller
{
    public function listClasses(Request $request)
    {
    	$classes = $_ENV['school']->classes->load('teachers');
    	return view('class.listviewer', ['classes' => $classes, 'url' => 'class', 'title' => 'Classes']);
    }

    public function showAddForm(Request $request)
    {
    	$teachers = $_ENV['school']->staff()->whereIn('role', ['teacher', 'headteacher'])->get();
    	return view('class.edit', ['url' => 'class/add', 'teachers' => $teachers, 'students' => [], 'title' => 'Add Class']);
    }

    public function add(Request $request)
    {
        $classInfo = $request->only(['class_form', 'academic_year']);
        $teachers = $request->input('teachers');
        $students = $request->input('students');
        $class = $_ENV['school']->classes()->create($classInfo);
        if($teachers)
        {
            $class->teachers()->attach($teachers);
        }
        if($students)
        {
            $students = Student::find($students);
            $class->students()->saveMany($students);
        }
        return redirect('class');
    }

    public function showEditForm(Request $request, string $form)
    {
		$class = $_ENV['school']->classes()->where('class_form', $form)->with('teachers')->with('students')->first();

    	dd($class);
        return view('class.edit', ['url' => 'class/edit', 'teachers']);
    }

    public function edit(Request $request, string $form)
    {
        $class = $_ENV['school']->classes()->where('class_form', $form)->first();
    }
}
