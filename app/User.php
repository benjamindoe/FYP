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
}