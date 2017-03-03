<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'class';


	public function teachers()
	{
		return $this->belongsToMany('App\Model\Staff');
	}
}
