<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\Staff;
use App\Model\Role;
use App\Model\School;
use App\User;

class StaffController extends Controller
{

	public function showSchoolStaffList(Request $request, int $urn)
	{
		$school = School::find($urn);
		$staff = $school->staff;
		return view('staff.listviewer', ['url' => 'schools/'.$urn.'/staff', 'staff' => $staff, 'title' => $school->establishment_name.' Staff']);
	}

	public function showStaffList(Request $request)
	{
		$staff = $_ENV['school']->staff;
		return view('staff.listviewer', ['url' => 'staff', 'staff' => $staff, 'title' => 'School Staff']);
	}

	public function showSchoolsStaffProfile(Request $request, int $urn, string $username)
	{
		$staff = User::where('username', $username)->first()->staff;
		return 0;
	}

	public function showStaffProfile(Request $request, string $username)
	{
		$staff = User::where('username', $username)->first()->staff;
		return 0;
	}

	public function showSchoolStaffAddForm(Request $request, int $urn)
	{
		return view('staff.edit', ['roles' => Role::all(), 'url' => url('schools/'.$urn.'/staff/add')]);
	}

	public function showAddForm(Request $request)
	{
		return view('staff.edit', ['roles' => Role::all(),  'url' => url('staff/add')]);
	}

	public function showSchoolStaffEditForm(Request $request, int $urn, string $username)
	{
		$staff = User::where('username', $username)->first()->staff;
		return view('staff.edit', ['staff' => $staff, 'edit' => true, 'roles' => Role::all(), 'url' => ('schools/'.$urn.'/staff/'.$staff->id.'/edit')]);
	}

	public function showEditForm(Request $request, string $username)
	{
		$staff = User::where('username', $username)->first()->staff;
		return view('staff.edit', ['staff' => $staff, 'edit' => true, 'roles' => Role::all(), 'url' => 'staff/'.$staff->id]);
	}

	public function addSchoolsStaff(Request $request, int $urn)
	{
		$staff = $this->staffAdder($request, $urn);
		return redirect('schools/'.$urn.'/staff/'.$staff->user->username);
	}

	public function addStaff(Request $request)
	{
		$urn = $_ENV['school']->getKey();
		$staff = $this->staffAdder($request, $urn);
		return redirect('staff/'.$staff->user->username);
	}

	public function editSchoolStaff(Request $request, int $urn, int $id)
	{
		$staff = $this->staffEditor($request, $id, $urn);
		return redirect('schools/'.$urn.'/staff/'.$staff->user->username);
	}

	public function editStaff(Request $request, int $id)
	{
		$urn = $_ENV['school']->getKey();
		$staff = $this->staffEditor($request, $id, $urn);
		return redirect('staff/'.$staff->user->username);
	}

	public function deleteSchoolStaff(Request $request, int $urn, int $id)
	{
		Staff::destroy($id);
		return redirect('schools/'.$urn.'/staff');
	}

	public function delete(Request $request, int $id)
	{
		Staff::destroy($id);
		return redirect('staff');
	}

	protected function staffEditor(Request $request, int $id, int $urn)
	{
		$this->validator($request->all())->validate();
		Validator::make($request->all(), [
			'password' => 'nullable|min:6|confirmed'
		])->validate();

		$staffInfo = $request->except(['_token', 'role']);
		$staffInfo['school_urn'] = $urn;
		$userInfo = $request->only(['username', 'password']);

		$staff = Staff::find($id)->update($staffInfo);
		if(null !== $request->input('role'))
			$staff->role = $request->input('role');

		$staff->user()->update($userInfo);
		$staff->save();
		return $staff;
	}

	protected function staffAdder(Request $request, int $urn)
	{
		$this->validator($request->all())->validate();
		Validator::make($request->all(), [
			'password' => 'required|min:6|confirmed'
		])->validate();
		$staffInfo = $request->only(['forename', 'surname']);
		$staffInfo['school_urn'] = $urn;
		$userInfo = $request->only(['username', 'password']);

		$staff = Staff::create($staffInfo);

		if(null !== $request->input('role'))
			$staff->role = $request->input('role');
		$user = $this->createUser($userInfo);
		$staff->user()->save($user);
		$staff->save();
		return $staff;
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
			'username'	=> 'required|max:255|unique:users',
			'forename'	=> 'required',
			'surname'	=> 'required',
		]);
	}

	protected function createUser(array $data)
	{
		return User::create([
			'username' => $data['username'],
			'password' => bcrypt($data['password'])
			]);
	}

}
