<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Upn extends Model
{
	protected $table = 'upn';

	protected $primaryKey = 'upn';

	public static function previousUpn($laNum, $estNum, $yrCode, $isTemp)
	{
		return Self::where([
			['year_code', $yrCode],
			['establishment_number', $estNum],
			['la_number', $laNum],
			['is_temp', $isTemp]
			])->orderBy('created_at', 'desc')->first();
	}
}
