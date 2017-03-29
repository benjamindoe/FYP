<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Subject;
use App\Model\ClassCloudResource;
use Carbon\Carbon;
use Storage;

class ClassCloudController extends Controller
{
	public function dashboard(Request $request)
	{
		$user = auth()->user();
		switch($user->userLevel())
		{
			case 3:
			//staff
				$classes = $user->staff->role == 'teacher' ? $user->staff->classes : $_ENV['school']->classes;
				return view('classcloud.class-dashboard', ['classes' => $classes]);
				break;
			case 2:
			//guardian
				$students = $user->guardian->students()->with('class')->get();
				return view('classcloud.parent-dashboard', ['students' => $students]);
				break;
			case 1:
				return redirect('classcloud/'.$user->student->class->class_form);
				break;
			default:
				abort(403);
			
		}
	}

	public function classDashboard(Request $request, $classForm)
	{
		$subjects = Subject::all();
		return view('classcloud.dashboard', ['subjects' => $subjects, 'title' => 'ClassCloud']);
	}


	public function subjectDashboard(Request $request, $classForm, $subject)
	{
		$subject = Subject::where('name', $subject)->with(['resources' => function ($query) use ($classForm)
		{
			$query->whereHas('classes', function ($query) use ($classForm)
			{
				$query->where('class_form', $classForm);
			});
			if(auth()->user()->student || auth()->user()->guardian)
			{
				$query->with(['unopened' => function ($query)
				{
					$query->where('user_id', auth()->user()->id);
				}]);
			}
		}])->first();
		return view('classcloud.subject-dashboard', ['resources' => $subject->resources]);
	}

	public function showAddResourceForm()
	{
		return view('classcloud.addresource');
	}

	public function showEditForm(Request $request, $classForm, $subject, $id)
	{
		$ccr = $this->findCcr($classForm, $subject, $id)->firstOrFail();
		return view('classcloud.addresource', ['resource' => $ccr]);
	}

	public function addResource(Request $request, $classForm, $subject)
	{
		$subject = Subject::where('name', $subject)->first();
		$class = $_ENV['school']->classes()->whereHas('academicYear', function($query) {
			$query->where('year_start', '<=', Carbon::today())
					->where('year_end', '>=', Carbon::today());
		})->where('class_form', $classForm)->with(['students' => function ($query) {
			$query->with('guardians');
		}])->first();
		$ccr = new ClassCloudResource;
		$ccr->name = $request->name;
		$ccr->notes = $request->notes;
		$ccr->status = $request->status;
		$ccr->class_id = $class->id;
		$ccr->subject_id = $subject->id;
		$path = $request->file('resource_file')->store('classcloud');
		$ccr->path = $path;
		$ccr->save();
		foreach($class->students as $student)
		{
			if($student->user)
				$ccr->unopened()->create(['user_id' => $student->user->id]);
			foreach($student->guardians as $guardian)
			{
				if($guardian->user)
					$ccr->unopened()->create([
						'user_id' => $guardian->user->id
					]);
			}
		}
		return redirect('classcloud/'.$classForm.'/'.$subject->name);
	}

	public function editResource(Request $request, $classForm, $subject, $id)
	{
		$ccr = $this->findCcr($classForm, $subject, $id)->firstOrFail();
		$ccr->name = $request->name;
		$ccr->notes = $request->notes;
		$ccr->status = $request->status;
		if($request->hasFile('resource_file'))
		{
			Storage::delete($ccr->path);
			$ccr->path = $request->file('resource_file')->store('classcloud');
		}
		$ccr->save();
		return redirect('classcloud/'.$classForm.'/'.$subject);
	}

	public function delete($classForm, $subject, $id)
	{
		$ccr = $this->findCcr($classForm, $subject, $id)->firstOrFail();
		Storage::delete($ccr->path);
		$ccr->delete();
		return redirect('classcloud/'.$classForm.'/'.$subject);
	}

	public function markRead(Request $request, $classForm, $subject, $id)
	{
		$ccr = $this->findCcr($classForm, $subject, $id)->firstOrFail();
		$u = $ccr->unopened()->where('user_id', auth()->user()->id)->first();
		if($u)
		{
			$u->delete();
			return response()->json(['success' => true]);
		}
		return response()->json(['message' => 'user already opened resource']);
	}

	protected function findCcr($classForm, $subject, $id)
	{
		return ClassCloudResource::whereHas('classes', function($query) use ($classForm) {
			$query->where('class_form', $classForm)->current();
		})->whereHas('subject', function ($query) use ($subject) {
			$query->where('name', $subject);
		})->where('id', $id);
	}

}
