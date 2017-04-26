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
	public function student()
	{
		return $this->belongsTo('App\Model\Student');
	}

	/**
	 * Returns whether current user is a guardian
	 * @return integer guardian ID
	 */
	public function guardian()
	{
		return $this->belongsTo('App\Model\Guardian', 'parent_id');
	}

	/**
	 * Return whether current user is a staff member
	 * @return integer staff ID
	 */
	public function staff()
	{
		return $this->belongsTo('App\Model\Staff');
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
		else if($this->staff !== null)
		{
			return 3;
		}
		else if ($this->guardian !== null)
		{
			return 2;
		}
		else if ($this->student !== null)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function role()
	{
		$role = 'guest';
		switch ($this->userLevel())
		{
			case 1:
				return 'student';
				break;
			case 2:
				return 'guardian';
				break;
			case 3:
				return 'staff';
				break;
			case 4:
				return 'super';
				break;
			case 0:
			default:
				return 'guest';
				break;
		}
	}

	public function getNameAttribute()
	{
		switch ($this->userLevel())
		{
			case 1:
				return $this->student->fullName;
				break;
			case 2:
				return $this->guardian->forename. ' '.$this->guardian->surname;
				break;
			case 3:
				return $this->staff->forename. ' '.$this->staff->surname;
				break;
			case 4:
				return 'Admin';
				break;
			case 0:
			default:
				return 'Guest';
				break;
		}
	}

	public function unopenedResources()
	{
		return $this->hasMany('App\Model\UnopenedResource');
	}
}