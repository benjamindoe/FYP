<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{

    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'staff';

	/**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['role'];

	/**
	 * Get the school of the staff member
	 */
	public function school()
	{
		return $this->belongsTo('App\Model\School', 'school_urn');
	}

	/**
	 * Get the user login details of the staff member
	 */
	public function user()
	{
		return $this->hasOne('App\User');
	}

	/**
	 * Get the classes of the teacher
	 */
	public function classes()
	{
		return $this->belongsToMany('App\Model\Classes');
	}	
}
