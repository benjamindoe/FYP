<?php

function division($a, $b)
{
	return $b === 0 ? 0 : $a/$b;
}

function createUser(array $data)
{
	return App\User::create([
		'username' => $data['username'],
		'password' => bcrypt($data['password'])
		]);
}
function validate_password($data)
{
	Validator::make($data, [
		'password' => 'required|min:6|confirmed'
	])->validate();
}

function preserve_nl($value)
{
	return nl2br(e($value));
}

function calculateYearGroup(Carbon\Carbon $dob)
{
	$receptionEndAge = 5;
	$minSchoolYear = -1;
	$maxSchoolYear = 14;
	$aug = Carbon\Carbon::parse('31 august this year');
	$age = $dob->diffInYears(Carbon\Carbon::now());
	$yearGroup = $dob->diffInYears($aug) - $receptionEndAge + 1;

	if($maxSchoolYear < $yearGroup || $yearGroup < $minSchoolYear)
		return false;

	return(['age' => $age, 'yearGroup' => $yearGroup]);
}