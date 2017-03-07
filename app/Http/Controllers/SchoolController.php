<?php

namespace App\Http\Controllers;

use App\Model\School;
use App\Model\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
	public function showSchoolInfo(Request $request)
	{
		if(Auth::user()->isSuperAdmin() && $id = null)
			return redirect(url('schools'));
	}

	public function showSchoolsList(Request $request)
	{
		$schools = School::all();
		return view('school.listviewer', ['title' => 'schools', 'schools' => $schools]);
	}

	public function showAddForm()
	{
		return view('school.edit', ['title' => 'Add School', 'url' => url('schools/add')]);
	}

	public function showEditForm(Request $request, int $id = null)
	{
		if(Auth::user()->staff)
		{
			$school = $_ENV['school'];
			$url = url('/school/edit');
		} else 
		{
			$school = School::find($id);
			$url = url('schools/'.$id.'/edit');
		}
		return view('school.edit', ['title' => 'Edit School', 'url' => $url, 'school' => $school, 'edit' => true]);
	}

	public function add(Request $request)
	{
		$this->validator($request->all())->validate();
		Validator::make($request->all(), [
			'address' => 'required'
		], [
			'address.required' => 'Address Required. Find the Address'
		])->validate();
		$addressInfo = $request->input('address');
		$addressInfo .= ', '.$request->input('postcode');
		$address = Address::createWithCommaString($addressInfo);
		$schoolInfo = $request->except(['address', 'postcode', '_token']);
		$schoolInfo['address_id'] = $address->id;
		$school = School::create($schoolInfo);
		return redirect(url('schools/'.$school->unique_reference_number));
	}

	public function edit(Request $request, int $id = null)
	{
		$school = School::find($id);
		$address = $request->input('address');
		$schoolInfo = $request->except(['address', 'postcode', '_token', 'unique_reference_number']);
		if(isset($address))
		{
			$address .= ', '.$request->input('postcode');
			$address = Address::createWithCommaString($address);
			$schoolInfo['address_id'] = $address->id;
		}
		$school->update($schoolInfo);
		return $this->showEditForm($request, $id);
	}

	public function delete(Request $request, int $id)
	{
		School::destroy($id);
		return redirect('schools');
	}

	/**
	 * Get a validator for an incoming school request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'unique_reference_number'	=> 'required|numeric|unique:school',
			'la_number'					=> 'required|numeric',
			'la_name'					=> 'required',
			'establishment_name'		=> 'required',
			'establishment_number'		=> 'required|numeric',
			'education_phase'			=> 'required',
			'establishment_status'		=> 'required',
			'postcode'					=> 'required',
		]);
	}
}
