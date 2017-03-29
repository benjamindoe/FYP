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