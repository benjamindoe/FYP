<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Model\Staff;
use App\Model\Role;
use App\Model\School;
use App\User;

class StaffController extends Controller
{

	public function showSchoolStaffList(Request $request, int $urn)
	{
		$school = School::findOrFail($urn);
		return view('staff.listviewer', ['url' => 'schools/'.$urn.'/staff', 'staff' => $school->staff, 'title' => $school->establishment_name.' Staff']);
	}

	public function showStaffList(Request $request)
	{
		$staff = $_ENV['school']->staff;
		return view('staff.listviewer', ['url' => 'staff', 'staff' => $staff, 'title' => 'School Staff']);
	}

	public function showSchoolsStaffProfile(Request $request, int $urn, string $username)
	{
		$staff = User::where('username', $username)->firstOrFail()->staff;
		return 0;
	}

	public function showStaffProfile(Request $request, string $username)
	{
		$staff = $this->staffFinder($username)->firstOrFail();
		return 0;
	}

	public function showSchoolStaffAddForm(Request $request, int $urn)
	{
		$school = School::findOrFail($urn);
		return view('staff.edit', ['roles' => Role::all(), 'title' => 'Add '.$school->establishment_name.' Staff']);
	}

	public function showAddForm(Request $request)
	{
		return view('staff.edit', ['roles' => Role::all(), 'title' => 'Add Staff']);
	}

	public function showSchoolStaffEditForm(Request $request, int $urn, string $username)
	{
		$staff = User::where('username', $username)->firstOrFail()->staff;
		return view('staff.edit', ['staff' => $staff, 'edit' => true, 'roles' => Role::all(), 'title' => 'Editing '.$school->establishment_name.' Staff Member']);
	}

	public function showEditForm(Request $request, string $username)
	{
		$staff = $this->staffFinder($username)->firstOrFail();
		return view('staff.edit', ['staff' => $staff, 'edit' => true, 'roles' => Role::all(), 'title' => 'Editing '.$staff->forename.' '.$staff->surname]);
	}

	public function addSchoolsStaff(Request $request, int $urn)
	{
		$staff = $this->staffAdder($request, $urn);
		return redirect('schools/'.$urn.'/staff/'.$staff->user->username);
	}

	public function addStaff(Request $request)
	{
		$staff = $this->staffAdder($request);
		return redirect('staff/'.$staff->user->username);
	}

	public function editSchoolStaff(Request $request, int $urn, string $username)
	{
		$staff = $this->staffEditor($request, $username, $urn);
		return redirect('schools/'.$urn.'/staff/'.$staff->user->username);
	}

	public function editStaff(Request $request, string $username)
	{
		$urn = $_ENV['school']->getKey();
		$staff = $this->staffEditor($request, $username, $urn);
		return redirect('staff/'.$staff->user->username);
	}

	public function deleteSchoolStaff(Request $request, int $urn, string $username)
	{
		$this->staffFinder($username, $urn)->delete();

		if($request->ajax())
			return response()->json(['success' => true]);

		return redirect('schools/'.$urn.'/staff');
	}

	public function delete(Request $request, string $username)
	{
		$this->staffFinder($username)->delete();

		if($request->ajax())
			return response()->json(['success' => true]);

		return redirect('staff');
	}

	protected function staffEditor(Request $request, string $username, $urn = null)
	{
		$this->validator($request->all())->validate();
		Validator::make($request->all(), [
			'password' => 'nullable|min:6|confirmed'
		])->validate();

		$staffInfo = $request->only(['forename', 'surname']);
		$userInfo['username'] = $request->only(['username']);
		if (!empty($request->input('password')))
			$userInfo['password'] = $request->input('password');

		$staff = $this->staffFinder($request->input('id'), $urn);
		$staff->update($staffInfo);
		if(null !== $request->input('role'))
			$staff->role = $request->input('role');

		$staff->user()->update($userInfo);
		$staff->save();
		return $staff;
	}

	protected function staffAdder(Request $request, $urn = null)
	{
		$this->validator($request->all())->validate();
		Validator::make($request->all(), [
			'password' => 'required|min:6|confirmed'
		])->validate();

		$staffInfo = $request->only(['forename', 'surname']);
		$userInfo = $request->only(['username', 'password']);

		$school = $_ENV['school'] ?? School::findOrFail($urn);
		$staff = $school->staff()->create($staffInfo);

		if($request->input('role') !== null)
			$staff->role = $request->input('role');
		$user = createUser($userInfo);
		$staff->user()->save($user);
		$staff->save();
		return $staff;
	}

	protected function staffFinder($username, $urn = null)
	{
		$school = $_ENV['school'] ?? School::findOrFail($urn);
		if(is_numeric($username))
			return $school->staff()->findOrFail($username);

		return $school->staff()->whereHas('user', function($query) use ($username) {
			$query->where('username', $username);
		});
	}

	/**
	 * Get a validator for an incoming staff request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'username'	=> [
				'required',
				'max: 255',
				Rule::unique('users')
					->ignore(Staff::findOrFail($data['id'])->user->id)
			],
			'forename'	=> 'required',
			'surname'	=> 'required',
		]);
	}

}
