<?php

namespace App\Http\Controllers;

use App\Model\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
	public function showAddForm()
	{
		return view('admin.school.edit', ['title' => 'Add School', 'url' => url('schools/add')]);
	}
	

	public function showEditForm(Request $request, $id)
	{
		$school = School::find($id);
	}

	public function add(Request $request)
	{
		$school = new School;
	}

	public function edit(Request $request, $id)
	{
		$school = School::find($id);
		return view('admin.school.edit', ['title' => 'Edit School', 'url' => 'edit', 'school' => $school]);
	}

	public function delete(Request $request, $id)
	{
		School::destroy($id);
	}
}
