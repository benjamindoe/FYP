<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'school';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
	 * The primary key of the table
	 *
	 * @var string
	 */
	protected $primaryKey = 'unique_reference_number';

	/**
	 * Get the address of the school
	 */
	public function address()
	{
		return $this->belongsTo('App\Model\Address', 'address_id');
	}

	/**
	 * Get the staff of the school
	 */
	public function staff()
	{
		return $this->hasMany('App\Model\Staff', 'school_urn', 'unique_reference_number');
	}

	/**
	 * Get the classes of the school
	 */
	public function classes()
	{
		return $this->hasMany('App\Model\Classes', 'school_urn', 'unique_reference_number');
	}

	/**
	 * Get the students of the school
	 */
	public function students()
	{
		return $this->belongsToMany('App\Model\Student', 'school_history', 'school_urn', 'student_id')->withPivot('arrival_date', 'leaving_date', 'leaving_reason');
	}

	/**
	 * Get the academic years of the school
	 */
	public function academicYears()
	{
		return $this->hasMany('App\Model\AcademicYear', 'school_urn', 'unique_reference_number');
	}
}
