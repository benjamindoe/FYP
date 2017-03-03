<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role 
{
	protected static $roles = [
		1 => 'admin',
		2 => 'teacher',
		3 => 'headteacher'
	];
    public static function all()
    {
    	return self::$roles;
    }
}
