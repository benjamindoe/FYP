<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $table = 'subject';
	
	public function resources()
	{
		return $this->hasMany('App\Model\ClassCloudResource');
	}
}
