<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

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
		return $this->student_id || $this->is_super_admin;
	}

	/**
	 * Returns whether current user is a parent
	 * @return integer parent ID
	 */
	public function isParent()
	{
		return $this->parent_id || $this->is_super_admin;
	}

	/**
	 * Return whether current user is a staff member
	 * @return integer staff ID
	 */
	public function isStaff()
	{
		return $this->staff_id || $this->is_super_admin;
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
			return 'super';
		}
		else if($this->isStaff())
		{
			return 'staff';
		}
		else if ($this->isParent())
		{
			return 'parent';
		}
		else
		{
			return 'student';
		}
	}
}