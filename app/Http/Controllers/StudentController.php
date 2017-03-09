<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;

class StudentController extends Controller
{
    public function showAddForm()
    {
    	return view('student.edit', ['url' => 'students/add', 'title' => 'Add Student Manually']);
    }

    public function add(Request $request)
    {
    	dd($request);
    	$student = new Student;
    	return redirect('student/'.$student->id);
    }
}
