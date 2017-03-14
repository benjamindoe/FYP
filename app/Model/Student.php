<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'student';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'created_at',
		'updated_at',
		'dob',
	];

	public function class()
	{
		return $this->belongsTo('App\Model\Classes');
	}

	public function guardians()
	{
		return $this->belongsToMany('App\Model\Guardian', 'student_parent');
	}

	public function UPN()
	{
		return $this->belongsTo('App\Model\Upn', 'upn', 'upn');
	}

	public function attendance()
	{
		return $this->hasMany('App\Model\Attendance', 'student_id');
	}

	/**
	 * Get the student's preferred full name.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getFullNameAttribute($value)
	{
		return (!empty($this->preferred_forename) ? $this->preferred_forename : $this->legal_forename).' '.(!empty($this->preferred_surname) ? $this->preferred_surname : $this->legal_surname);
	}

	/**
	 * Get the student's legal full name.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getLegalFullNameAttribute($value)
	{
		return $this->legal_forename.' '.$this->legal_surname;
	}

}
