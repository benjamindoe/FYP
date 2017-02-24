<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/** 
	 * Returns whether current user is a student
	 *
	 * @return integer student ID;
	 * 
	 */
	public function isStudent()
	{
		return $this->student_id;
	}

	/**
	 * Returns whether current user is a parent
	 * @return integer parent ID
	 */
	public function isParent()
	{
		return $this->parent_id;
	}

	/**
	 * Return whether current user is a staff member
	 * @return integer staff ID
	 */
	public function isStaff()
	{
		return $this->staff_id;
	}

	/**
	 * Return whether current user is the super admin
	 * @return integer staff ID
	 */
	public function isSuperAdmin()
	{
		return $this->is_super_admin;
	}

	public function userLevel()
	{
		if($this->isSuperAdmin())
		{
			return 4;
		}
		else if($this->isStaff())
		{
			return 3;
		}
		else if ($this->isParent())
		{
			return 2;
		}
		else if ($this->isStudent())
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}